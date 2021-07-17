<?php


namespace Tests\Unit;


use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class JsonFilteringTest extends TestCase
{
    protected $methode      = "POST";
    protected $request_path = "api/products/filter";

    /**
     * testing the success response.
     *
     * @return void
     */
    public function test_success_process()
    {
        $path=base_path().'/storage/valid.json';
        $file = new UploadedFile($path, 'valid.json', filesize($path), null, null, true);
        $name   ="Suit1";
        $pvp    =2000;

        $response = $this->json($this->methode, $this->request_path, [
            'file' => $file,
            'name' => $name,
            'pvp'  => $pvp
        ])->assertStatus(200);

    }

    /**
     * testing the missing file case.
     *
     * @return void
     */
    public function test_missing_file()
    {
        $name   ="Suit1";
        $pvp    =2000;

        $response = $this->json($this->methode, $this->request_path, [
            'name' => $name,
            'pvp'  => $pvp
        ])->assertStatus(500);
    }

    /**
     * testing the invalid file case.
     *
     * @return void
     */
    public function test_sending_invalid_file()
    {
        $path=base_path().'/storage/invalid.json';
        $file = new UploadedFile($path, 'invalid.json', filesize($path), null, null, true);
        $name   ="Suit1";
        $pvp    =2000;

        $response = $this->json($this->methode, $this->request_path, [
            'file' => $file,
            'name' => $name,
            'pvp'  => $pvp
        ])->assertStatus(500);    }

}
