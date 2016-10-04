<?php
class Download{
	public function handle($data){
    $id = $data['id'];
    $repo = new FileRepository();

    $savedFile = $repo->download($id);





		header("Content-Type:" . $savedFile['type']);
		header("Content-Length:" . $savedFile['size']);
		header("Content-Disposition: attachment; filename=\"$savedFile['name']\""); //http://www.media-division.com/the-right-way-to-handle-file-downloads-in-php/ (Tydligen är det så här man gör :P)

		echo $savedFile['data'];


		//return $savedFile;


    } else {
      throw new Exception("Fel vid hämtning av fil!");
    }

	}
}
