<?php
class Upload{
	public function handle($data, $postdata){
		$repo = new FileRepository();
		$file = null;

    //Array of approved file types
    $okTypes = [
      'application/pdf',//PDF
      'text/plain'//TXT
    ];

    //Check if file type is ok - Finish later, not important now!
    /*
    $typeCheck = 0;
    foreach ($okTypes as $key => $value) {
      if ($value === $data['file']['type']){
        $typeCheck = 1;
        break;
      }
    }*/


    if ($data['error'] == 0){
      $file = new File();
      $file->name = $data['file']['name'];
      $file->type = $data['file']['type'];

      //Parse data from temporary file
      $file->data = fopen($data['file']['tmp_name'], 'rb');

      $file->size = $data['file']['size'];
      $file->meetingID = $postdata['meetingID'];

      //Return file info using Download handler

      $savedFile = $repo->upload($file);

      $response->id = $savedFile->id;
      $response->name = $savedFile->name;
      $response->type = $savedFile->type;
      $response->meetingID = $savedFile->meetingID;
      $response->size = $savedFile->size;

      return $response;



    } else {
      throw new Exception("Fel vid uppladdning: ");
    }

	}
}
