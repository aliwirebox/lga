<?php

function getStorageFilePath($disk, $filename)
{
    $path = Storage::disk($disk)->getDriver()->getAdapter()->getPathPrefix();

    return $path . $filename;
}
