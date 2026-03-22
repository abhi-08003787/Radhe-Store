<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ImageUploadController extends Controller
{
    /**
     * Upload image to storage (local or Cloudinary) and return path/URL
     */
    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $folder = $request->input('folder', 'products');
                
                // Check if using Cloudinary (production) or local storage
                if (env('APP_ENV') === 'production') {
                    // Upload to Cloudinary
                    $uploadedFileUrl = Cloudinary::upload($file->getRealPath(), [
                        'folder' => $folder,
                        'resource_type' => 'image',
                        'format' => 'webp',
                        'quality' => 'auto',
                        'crop' => 'limit',
                        'width' => 800,
                        'height' => 800
                    ])->getSecurePath();

                    return response()->json([
                        'success' => true,
                        'url' => $uploadedFileUrl,
                        'message' => 'Image uploaded to Cloudinary successfully'
                    ]);
                } else {
                    // Upload to local storage
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs($folder, $filename, 'public');
                    
                    return response()->json([
                        'success' => true,
                        'path' => $path, // e.g., "products/image.jpg"
                        'url' => asset('storage/' . $path),
                        'message' => 'Image uploaded to local storage successfully'
                    ]);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'No image file provided'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete image from Cloudinary
     */
    public function deleteImage(Request $request)
    {
        try {
            $request->validate([
                'public_id' => 'required|string',
            ]);

            // Extract public_id from Cloudinary URL
            $imageUrl = $request->input('public_id');
            $publicId = $this->extractPublicId($imageUrl);

            if ($publicId) {
                Cloudinary::destroy($publicId);
                return response()->json([
                    'success' => true,
                    'message' => 'Image deleted successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid public ID'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Delete failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Extract public_id from Cloudinary URL
     */
    private function extractPublicId($url)
    {
        if (preg_match('/cloudinary\.com\/[^\/]+\/image\/upload\/v1\/([^\.]+)/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * Get image info from Cloudinary
     */
    public function getImageInfo(Request $request)
    {
        try {
            $request->validate([
                'public_id' => 'required|string',
            ]);

            $publicId = $this->extractPublicId($request->input('public_id'));
            
            if ($publicId) {
                $imageInfo = Cloudinary::getAsset($publicId);
                
                return response()->json([
                    'success' => true,
                    'data' => $imageInfo
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid public ID'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Get info failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
