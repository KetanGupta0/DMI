<?php

namespace App\Libraries;

class FileValidator
{
    public function validatePhoto($file)
    {
        // Check if a file was uploaded
        if (!$file->isValid()) {
            return false; // File upload failed
        }

        // Check file type (e.g., allow only image files)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return false; // Invalid file type
        }

        // Set the maximum file size to 1MB
        $maxSize = 1 * 1024 * 1024; // 1MB

        // Check file size
        if ($file->getSize() > $maxSize) {
            return false; // File size exceeds the limit
        }

        // All checks passed, the photo is valid
        return true;
    }

    public function validateSignature($file)
    {
        // Check if a file was uploaded
        if (!$file->isValid()) {
            return false; // File upload failed
        }

        // Check file type (e.g., allow only image files)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return false; // Invalid file type
        }

        // Set the maximum file size to 1MB
        $maxSize = 1 * 1024 * 1024; // 1MB

        // Check file size
        if ($file->getSize() > $maxSize) {
            return false; // File size exceeds the limit
        }

        // All checks passed, the signature is valid
        return true;
    }
}

