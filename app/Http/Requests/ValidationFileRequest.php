<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Xenolope\VirusTotal\VirusTotal;

class ValidationFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected $virusTotal;

    /**
     * @param VirusTotal $virusTotal
     */
    public function __construct(VirusTotal $virusTotal){
        $this->virusTotal=$virusTotal;
    }
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'files' => ['required', 'array', 'min:1', 'max:10',
                'files.*' => [
                    'required',
                    'file',
                    'mimes:jpg,jpeg,png,gif,doc,docx,pdf',
                    'max:2048'
                ]]];

        protected
        function prepareForValidation()
        {
            $files = $this->file('files');
            foreach (files as file ){
                $result=$this->virusTotal->scanFile($file)->getPathname());
              if($result['positives']>0){
                  abort(422,'The file  with the virus was  found');
              }

        }

        }



    }


}
