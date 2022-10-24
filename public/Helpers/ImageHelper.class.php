<?php
    namespace Helpers;

    class ImageHelper {
        public static function getBase64FromBlob($blobImageContents) {
            return base64_encode($blobImageContents);
        }
    }
?>