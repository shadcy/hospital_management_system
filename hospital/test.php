<?php
require 'vendor/php/vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

$storage = new StorageClient(['keyFilePath' => 'vendor/php/vast-reality-405314-a522a0fd7428.json']);

$bucket = $storage->bucket('iitbhms-test-bucket-123');

// Upload a file to the bucket.
// $bucket->upload(
//     fopen('file.txt', 'r')
// );

// Download and store an object from the bucket locally.
$object = $bucket->object('file.txt');
$expiration = new DateTime('+5 minutes');
$signedUrl = $object->signedUrl($expiration);

// Output the signed URL
?>
<a href="<?= $signedUrl ?>">Download</a>