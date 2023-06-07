<?php


include_once("KontrakView.php");
include_once("presenter/ProsesFormPasien.php");

class FormPasienView implements KontrakVIew
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new FormPasienPresenter();
	}

	function tampil()
	{
		$data = null;
		$data .= 
	  '<form method="post" action="form.php">
		  <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" name="nik" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tempat">Tempat</label>
            <input type="text" name="tempat" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal Lahir</label>
            <input type="date" name="lahir" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" required>
				<option value="">Pilih Gender</option>
				<option value="Laki-laki">Laki-laki</option>
				<option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="telepon">No Telepon</label>
            <input type="tel" name="telp" class="form-control" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary mr-2" name="add">Tambah</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
          </div>
        </form>';

		// Membaca template skin.html
		$this->tpl = new Template("templates/form.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_FORM", $data);
		$this->tpl->replace("TITLE", "Tambah");


		// Menampilkan ke layar
		$this->tpl->write();
	}

	function tampilUpdate($id)
	{
		$this->prosespasien->prosesDataPasien();
		$listGender = ['Laki-laki', "Perempuan"];
		$dataGender = '<option value="">Pilih Gender</option>';
		foreach ($listGender as $temp) {
			if ($temp == $this->prosespasien->getGender($id)) { // jika group id dari database adalah group id pilihan user yang mau di update maka group id itu akan dikecualikan
				$dataGender .= '<option value="' . $temp . '" selected>' . $temp . '</option>';
			} else {
				$dataGender .= '<option value="' . $temp . '">' . $temp . '</option>';
			}
		}
		$data = null;
		$data .=
        '<form method="post" action="form.php">
		  <div class="form-group">
			<input type="hidden" name="id" value="' . $this->prosespasien->getId($id) . '" >
            <label for="nik">NIK</label>
            <input type="text" name="nik" class="form-control" value="' . $this->prosespasien->getNik($id) . '" required>
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" value="' . $this->prosespasien->getNama($id) . '" required>
          </div>
          <div class="form-group">
            <label for="tempat">Tempat</label>
            <input type="text" name="tempat" class="form-control" value="' . $this->prosespasien->getTempat($id) . '" required>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal Lahir</label>
            <input type="date" name="lahir" class="form-control" value="' . $this->prosespasien->getTl($id) . '" required>
          </div>
          <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" value="' . $this->prosespasien->getGender($id) . '" required>
              DATA_GENDER
            </select>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="' . $this->prosespasien->getEmail($id) . '" required>
          </div>
          <div class="form-group">
            <label for="telepon">No Telepon</label>
            <input type="tel" name="telp" class="form-control" value="' . $this->prosespasien->getTelp($id) . '" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary mr-2" name="update">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
          </div>
        </form>';

		// Membaca template skin.html
		$this->tpl = new Template("templates/form.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_FORM", $data);
		$this->tpl->replace("TITLE", "Update");
		$this->tpl->replace("DATA_GENDER", $dataGender);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function addPasien($data)
	{
		$this->prosespasien->addPasien($data);
	}

	function updatePasien($data)
	{
		$this->prosespasien->updatePasien($data);
	}
}