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

      //print_r($file->data);

      return $repo->upload($file);

      //Return file info using Download handler

    } else {
      throw new Exception("Fel vid uppladdning: ");
    }

	}
}
