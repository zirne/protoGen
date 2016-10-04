<?php
class Download{
	public function handle($data){
    $id = $data['id'];
    $repo = new FileRepository();

    $savedFile = $repo->download($id);

		return $savedFile;


    } else {
      throw new Exception("Fel vid hämtning av metadata!");
    }

	}
}
