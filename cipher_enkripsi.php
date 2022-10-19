<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">ENKRIPSI CAESAR & VIGENERE CIPHER</h1>
	
</div>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-xl-8 col-lg-12 col-md-9">

  			<div class="card o-hidden border-0 shadow-lg my-3">
  			  <div class="card-body p-0">
      				<div class="row">
      				  <div class="col-lg-12">
      				    <div class="p-5">
      				      <div>
								<h1 class="h1 text-gray-900 mb-4 text-center">Form Input</h1>       
                                <!--form input text dan key -->
								<form class="user" method="POST"> 
							        <div class="form-group">
								        <input id="username" type="text" name="input_text" class="form-control form-control-user" placeholder="Masukkan text" required>
							        </div>
							        <div class="form-group">
								        <input id="username" type="number" name="input_key" class="form-control form-control-user" placeholder="key caesar" required>
							        </div>
								        <input type="submit" name="enkripsi_caesar" value="Enkripsi" class="btn btn-danger btn-user">
							        <hr>
						        </form>

							  	<h1 class="h6 text-gray-900 mb-4 fw-blod">Output Caesar Cipher: </h1> 
								<!-- output hasil enkripsi dan deskripsi -->
                                <div class="my-2">
                                    <?php 
                                    
                                        $output = ""; //variable penampung output caesar cipher 

                                    	function cipher($char, $key){ //membuat fungsi cipher
                                    		if (ctype_alpha($char)) { //cek alphabet atau tidak
                                    			$nilai = ord(ctype_upper($char) ? 'A' : 'a'); 
                                    			$ch = ord($char); //konvensi ke karakter ASCII
                                    			$mod = fmod($ch + $key - $nilai, 26); //perhitangan modulus
                                    			$hasil = chr($mod + $nilai);  //hasil modulus ditambah dengan nilai dan konversi ke bentuk alphabet
                                    			return $hasil; 
                                    		} else { //mengebalikan nilai inputan jika selain alphabet
                                    			return $char;
                                    		}
                                    	}
                                    
                                        if(isset($_POST['enkripsi_caesar'])){ //cek enkripsi
                                            $text_input = $_POST['input_text']; //deklarasi text inputan
                                    		$kunci = $_POST['input_key']; //deklarasi number key
                                        
                                    		$chars = str_split($text_input); //variabel untuk menampung data yang diinput
                                        
                                    		foreach ($chars as $char) { //perulangan untuk menampilkan data array
                                    			$output .= cipher($char, $kunci); //menjalankan fungsi cipher
                                    		}
                                        
                                    		$chars_output = str_split($output); //variabel untuk menampung data yang dienkripsi untuk dideskripsikan
                                    		$deskripsi = ""; //variable penampung deskripsi
                                        
                                    		foreach ($chars_output as $char) { //perulangan untuk menampilkan data array
                                    			$deskripsi .= cipher($char, 26 - $kunci); //mengembalikan fungsi cipher
                                    		}

                                    		//pemanggilan variable untuk ditampilkan di output
                                            echo "	
                                    				<p> Text yang dienkripsi : <strong>"."$deskripsi"."</strong></p>
                                    				<p> Key : <strong>"."$kunci"."</strong></p>
                                    				<p> Hasil : </p>
                                            ";

                                        }
                                    ?>
                                </div> 
								<form class="user" method="POST"> 
							        <div class="form-group">
								        <input id="username" type="text" name="input_text" class="form-control form-control-user text-center font-weight-bold text-uppercase" value="<?php echo $output;?>" readonly>
							        </div>
                            <hr>
							        <div class="form-group">
								        <input id="username" type="text" name="input_key" class="form-control form-control-user" placeholder="key vigere" required>
							        </div>
								        <input type="submit" name="enkripsi_vigere" value="Enkripsi" class="btn btn-danger btn-user">
							        <hr>
						        </form>

							  	<h1 class="h6 text-gray-900 mb-4 fw-blod">Output Vigenere Cipher: </h1> 
								<!-- output hasil enkripsi dan deskripsi -->
                                <div class="my-2">
                                <?php

                                    $output_vigere ="";

                                    //fungsi enkripsi
                                    function enkripsi($key, $text) {
                                    	$key = strtolower($key); //ubah key ke lowercase

                                    	// inisialisasi variable
                                    	$ki = 0;
                                    	$kl = strlen($key);
                                    	$length = strlen($text);
                                    
                                    	// lakukan perulangan untuk setiap abjad
                                    	for ($i = 0; $i < $length; $i++){
                                    		
                                            // cek text
                                    		if (ctype_alpha($text[$i])){

                                    			// jika text merupakan huruf kapital (semua)
                                    			if (ctype_upper($text[$i])){
                                    				$text[$i] = chr(((ord($key[$ki]) - ord("a") + ord($text[$i]) - ord("A")) % 26) + ord("A"));
                                    			}
                                            
                                    			// jika text merupakan huruf kecil (semua)
                                    			else{
                                    				$text[$i] = chr(((ord($key[$ki]) - ord("a") + ord($text[$i]) - ord("a")) % 26) + ord("a"));
                                    			}
                                            
                                    			// update the index of key
                                    			$ki++;
                                    			if ($ki >= $kl) {
                                    				$ki = 0;
                                    			}
                                    		}
                                    	}
                                    
                                    	// mengembalikan nilai text
                                    	return $text;
                                    }

                                    if(isset($_POST['enkripsi_vigere'])){ //cek enkripsi
                                        $text = $_POST['input_text'];; //deklarasi text inputan
                                        $kunci = $_POST['input_key']; //deklarasi number key
	
	                                    // cek password
	                                    if (empty($kunci)){
	                                    	$error = "Masukkan Password";
	                                    	$valid = false;
	                                    }
                                    
	                                    // cek password tidak boleh angka
	                                    else if (isset($_POST['key']))
	                                    {
	                                    	if (!ctype_alpha($_POST['key']))
	                                    	{
	                                    		$error = "Password harus text!";
	                                    		$valid = false;
	                                    	}
	                                    }

                                        $output_vigere = enkripsi($kunci, $text);

                                        //pemanggilan variable untuk ditampilkan di output
                                        echo "	
                                                <p> Text yang dienkripsi : <strong>"."$text"."</strong></p>
                                                <p> Key : <strong>"."$kunci"."</strong></p>
                                                <p> Hasil : </p>
                                        ";
                                    }

                                    ?>

                                </div>
								<form class="user" method="POST"> 
							        <div class="form-group">
								        <input id="username" type="text" name="input_text" class="form-control form-control-user text-center font-weight-bold text-uppercase" value="<?php echo $output_vigere;?>" readonly>
							        </div>
							        <hr>
						        </form>


            			  </div>
      				    </div>
         			  </div>
        			</div>
             </div>
            </div>
  
		</div>
	</div>
</div>  