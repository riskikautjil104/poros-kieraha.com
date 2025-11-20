<?php

namespace App\Helpers;

class HtmlPurifier
{
    /**
     * Clean HTML content untuk mencegah XSS
     * Allowing safe tags untuk Rich Text Editor
     */
    public static function clean($html)
    {
        // Allowed tags untuk konten berita
        $allowedTags = '<p><br><strong><b><em><i><u><strike><h1><h2><h3><h4><h5><h6>' .
                       '<ul><ol><li><a><img><blockquote><code><pre><table><thead><tbody>' .
                       '<tr><th><td><span><div>';

        // Strip tags yang tidak diizinkan
        $cleaned = strip_tags($html, $allowedTags);

        // Remove potentially dangerous attributes
        $cleaned = preg_replace('/<([^>]+)on\w+="[^"]*"/i', '<$1', $cleaned);
        $cleaned = preg_replace('/<([^>]+)on\w+=\'[^\']*\'/i', '<$1', $cleaned);
        
        return $cleaned;
    }
}