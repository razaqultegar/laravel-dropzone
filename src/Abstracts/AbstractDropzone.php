<?php

namespace RazaqulTegar\Dropzone\Abstracts;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RazaqulTegar\Dropzone\Models\Dropzone as DropzoneModel;

abstract class AbstractDropzone
{
    protected $fieldValue = null;

    protected bool $isMultipleUpload = true;

    protected string $tempDisk = 'local';

    protected bool $isHavePermission = true;

    protected $fieldModel = null;

    /**
     * Get the decrypted field value.
     *
     * @return array|string|null
     */
    protected function getFieldValue()
    {
        return $this->fieldValue;
    }

    /**
     * Set the Dropzone encrypted field value.
     *
     * @param array|string|null $fieldValue
     * @return $this
     */
    protected function setFieldValue(array|string|null $fieldValue)
    {
        if (! $fieldValue) {
            $this->fieldValue = null;
            return $this;
        }

        $this->isMultipleUpload = is_array($fieldValue);

        $this->fieldValue = $this->isMultipleUpload
            ? array_map([$this, 'decrypt'], $fieldValue)
            : $this->decrypt($fieldValue);

        return $this;
    }

    /**
     * Return whether the field is multiple upload.
     *
     * @return bool
     */
    protected function getIsMultipleUpload()
    {
        return $this->isMultipleUpload;
    }

    /**
     * Decrypt the field value.
     *
     * @param string $data
     * @return mixed
     */
    protected function decrypt(string $data)
    {
        return Crypt::decrypt($data);
    }

    /**
     * Get the temporary disk used to store files.
     *
     * @return string
     */
    public function getTempDisk()
    {
        return $this->tempDisk;
    }

    /**
     * Set the temporary disk.
     *
     * @param string $tempDisk
     * @return $this
     */
    public function setTempDisk(string $tempDisk)
    {
        $this->tempDisk = $tempDisk;
        return $this;
    }

    /**
     * Get whether permission check is enabled.
     *
     * @return bool
     */
    protected function getIsHavePermission()
    {
        return $this->isHavePermission;
    }

    /**
     * Set permission check toggle.
     *
     * @param bool $isHavePermission
     * @return $this
     */
    protected function setIsHavePermission(bool $isHavePermission)
    {
        $this->isHavePermission = $isHavePermission;
        return $this;
    }

    /**
     * Get model(s) from field.
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null
     */
    protected function getFieldModel()
    {
        return $this->fieldModel;
    }

    /**
     * Retrieve model(s) associated with uploaded field.
     *
     * @param string $model
     * @return $this
     */
    protected function setFieldModel(string $model)
    {
        if (! $this->getFieldValue()) {
            $this->fieldModel = null;
            return $this;
        }

        $query = $model::when($this->isHavePermission, function ($query) {
            return $query->permission();
        });

        $this->fieldModel = $this->isMultipleUpload
            ? $query->whereIn('id', collect($this->fieldValue)->pluck('id'))->get()
            : $query->find($this->fieldValue['id']);

        return $this;
    }

    /**
     * Generate UploadedFile object from Dropzone model.
     *
     * @param DropzoneModel $dropzone
     * @return UploadedFile
     */
    protected function createFileObject(DropzoneModel $dropzone)
    {
        return new UploadedFile(
            Storage::disk($this->tempDisk)->path($dropzone->filepath),
            $dropzone->filename,
            $dropzone->mimetypes,
            \UPLOAD_ERR_OK,
            true
        );
    }
}
