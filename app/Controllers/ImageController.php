<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ImageController extends Controller
{
    public function serveImage($image)
    {
        // Path to the image file stored in the writable/uploads/staff directory
        $filePath = WRITEPATH . 'uploads/staff/' . $image;        // Check if the file exists
        if (file_exists($filePath)) {
            // Get the file's mime type
            $mimeType = mime_content_type($filePath);

            // Set the appropriate header for the file type
            return $this->response->setHeader('Content-Type', $mimeType)
                                  ->setBody(file_get_contents($filePath));
        } else {
            // Return a 404 error if the file doesn't exist
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND, 'Image not found');
        }
    }
}
