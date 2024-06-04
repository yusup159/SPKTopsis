<?php
defined('BASEPATH') OR exit('No direct sript acces allowed');

class Auth extends CI_Controller{
  public function __construct() {
    parent::__construct();
    $this->load->model('Mtopsis');
    $this->load->library('form_validation');
  }
  public function index(){
    $this->load->view('admin/login');
  }
  public function register(){
    $this->load->view('admin/registrasi');
  }
  public function proses_login(){
    $this->form_validation->set_rules('username', 'Username', 'required', ['required' => 'Isi username lah bang']);
    $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Isi password juga lah bang']);
    if ($this->form_validation->run() == FALSE){
        $this->load->view('admin/login');
    } else {
        $this->load->model('Mtopsis');
        $u = $this->input->post('username');
        $p = $this->input->post('password');
        $auth = $this->db->get_where('admin', ['Username' => $u])->row_array(); // sesuaikan dengan nama kolom di tabel admin
        if (!$auth) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username tidak ditemukan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('auth');
        } else {
            if (password_verify($p, $auth['Password'])) { // sesuaikan dengan nama kolom di tabel admin
                $this->session->set_userdata('username', $auth['Username']); // sesuaikan dengan nama kolom di tabel admin
                redirect('auth/dashboard');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Password tidak sesuai
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>'); 
                redirect('auth'); 
            }
        }
    }
}

public function proses_registrasi(){
  $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'Isi username lah bang']);
  $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', ['matches' => 'Password tidak sesuai', 'required' => 'Password Wajib diisi']);
  $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

  if ($this->form_validation->run() == FALSE){
      $this->load->view('admin/registrasi');
  } else {
      $data = [
          'Username' => $this->input->post('username'),
          'Password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT) 
      ];

      $this->db->insert('admin', $data);

      $this->session->set_flashdata('pesan', 'Registrasi berhasil. Silakan login.');

      redirect('auth');
  }
}

  public function logout(){
    $this->session->sess_destroy();
    redirect('auth');
  }
  public function dashboard(){
    if (!$this->session->userdata('username')) {
      redirect('auth');
    }
    $this->load->view('admin/dashboard/header');
    $this->load->view('admin/dashboard/sidebar');
    $this->load->view('admin/dashboard/menu');
    $this->load->view('admin/dashboard/footer');
  }
  public function tampil_karyawan(){
    if (!$this->session->userdata('username')) {
      redirect('auth');
    }
    $data['karyawan'] = $this->Mtopsis->getKaryawanData();
    $this->load->view('admin/dashboard/header');
    $this->load->view('admin/dashboard/sidebar');
    $this->load->view('admin/data/tampilkaryawan',$data);
    $this->load->view('admin/dashboard/footer');
  }
  public function tampil_kriteria(){
    if (!$this->session->userdata('username')) {
      redirect('auth');
    }
    $data['kriteria'] = $this->Mtopsis->getKriteriaData();
    $this->load->view('admin/dashboard/header');
    $this->load->view('admin/dashboard/sidebar');
    $this->load->view('admin/data/tampilkriteria',$data);
    $this->load->view('admin/dashboard/footer');
  }
  public function tampil_matrix(){
    if (!$this->session->userdata('username')) {
      redirect('auth');
    }
    $data['matrix'] = $this->Mtopsis->getMatrixData();
    $data['karyawan'] = $this->Mtopsis->getKaryawanData();
    $data['kriteria'] = $this->Mtopsis->getKriteriaData();
    $this->load->view('admin/dashboard/header');
    $this->load->view('admin/dashboard/sidebar');
    $this->load->view('admin/data/tampilmatrix', $data); 
    $this->load->view('admin/dashboard/footer');
  } 
  public function insertKaryawan() {
    $data = array(
        'NamaKaryawan' => $this->input->post('nama_karyawan'),
        'Jabatan' => $this->input->post('jabatan'),
        'Alamat' => $this->input->post('alamat'),
        'GajiSaatIni' => $this->input->post('gaji')
    );
    $karyawan_id = $this->Mtopsis->insertKaryawan($data);
    if ($karyawan_id) {
        $this->session->set_flashdata('messagekaryawan', 
          'Data karyawan berhasil ditambahkan dengan ID: ' . $karyawan_id . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
    } else {
        $this->session->set_flashdata('messagekaryawan', 'Gagal menambahkan data karyawan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
    }
    redirect('auth/tampil_karyawan');
  }
  public function editKaryawanForm($karyawan_id) {
    if (!$this->session->userdata('username')) {
      redirect('auth');
    }
    $data['karyawan'] = $this->Mtopsis->getKaryawanById($karyawan_id);
    $this->load->view('admin/dashboard/header');
    $this->load->view('admin/dashboard/sidebar');
    $this->load->view('admin/edit/editkaryawan', $data); 
    $this->load->view('admin/dashboard/footer');
  }
  public function updateKaryawan($karyawan_id) {
    $data = array(
      'NamaKaryawan' => $this->input->post('nama_karyawan'),
      'Jabatan' => $this->input->post('jabatan'),
      'Alamat' => $this->input->post('alamat'),
      'GajiSaatIni' => $this->input->post('gaji')
    );
    $result = $this->Mtopsis->updateKaryawan($karyawan_id, $data);
  if ($result) {
      $this->session->set_flashdata('messagekaryawan', 
        'Data karyawan berhasil di update
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>');
  } else {
      $this->session->set_flashdata('messagekaryawan', 'Gagal mengUpdate.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>');
  }
    redirect('auth/tampil_karyawan');
  }
  public function insertKriteria() {
    $data = array(
      'NamaKriteria' => $this->input->post('nama_kriteria'),
      // 'BobotKriteria' => $this->input->post('bobot'),
      'Status' => $this->input->post('status')
    );
    $kriteria_id = $this->Mtopsis->insertKriteria($data);
    if ($kriteria_id) {
        $this->session->set_flashdata('messagekriteria', 
          'Data kriteria berhasil ditambahkan dengan ID: ' . $kriteria_id . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
    } else {
        $this->session->set_flashdata('messagekriteria', 'Gagal menambahkan data kriteria.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
    }

    redirect('auth/tampil_kriteria');
  }
  public function editKriteriaForm($kriteria_id) {
    if (!$this->session->userdata('username')) {
      redirect('auth');
    }
    $data['kriteria'] = $this->Mtopsis->getKriteriaById($kriteria_id);
    $this->load->view('admin/dashboard/header');
    $this->load->view('admin/dashboard/sidebar');
    $this->load->view('admin/edit/editkriteria', $data); 
    $this->load->view('admin/dashboard/footer');
  }
  public function updateKriteria($kriteria_id) {
    $data = array(
      'NamaKriteria' => $this->input->post('nama_kriteria'),
      'BobotKriteria' => $this->input->post('bobot'),
      'Status' => $this->input->post('status'),
    );
    $result = $this->Mtopsis->updateKriteria($kriteria_id, $data);
    if ($result) {
      $this->session->set_flashdata('messagekriteria', 
        'Data kriteria berhasil di update
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>');
  } else {
      $this->session->set_flashdata('messagekriteria', 'Gagal mengUpdate.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>');
  }
    redirect('auth/tampil_kriteria');
  }
  public function insertMatrix() {
    $id_karyawan = $this->input->post('id_karyawan');
    $id_kriteria = $this->input->post('id_kriteria');
    if ($this->Mtopsis->isMatrixExists($id_karyawan, $id_kriteria)) {
        $this->session->set_flashdata('messagematrix', 'Data matrix dengan ID Karyawan dan Kriteria tersebut sudah ada.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
        redirect('auth/tampil_matrix');
        return;
    }
    $data = array(
        'ID_Karyawan' => $id_karyawan,
        'ID_Kriteria' => $id_kriteria,
        'Nilai' => $this->input->post('nilai_matrix')
    );
    $matrix_id = $this->Mtopsis->insertMatrix($data);
    if ($matrix_id) {
        $this->session->set_flashdata('messagematrix', 'Data matrix berhasil ditambahkan dengan ID: ' . $matrix_id . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
    } else {
        $this->session->set_flashdata('messagematrix', 'Gagal menambahkan data matrix.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
    }

    redirect('auth/tampil_matrix');
    }
  public function editMatrixForm($matrix_id) {
    if (!$this->session->userdata('username')) {
      redirect('auth');
    }
    $data['matrix'] = $this->Mtopsis->getMatrixById($matrix_id);
    $data['karyawan'] = $this->Mtopsis->getKaryawanData();
    $data['kriteria'] = $this->Mtopsis->getKriteriaData();
    $this->load->view('admin/dashboard/header');
    $this->load->view('admin/dashboard/sidebar');
    $this->load->view('admin/edit/editmatrix', $data); 
    $this->load->view('admin/dashboard/footer');
  }
  public function updateMatrix($matrix_id) {
    $id_karyawan = $this->input->post('id_karyawan');
    $id_kriteria = $this->input->post('id_kriteria');
    if ($this->Mtopsis->nilaiMatrixExists($id_karyawan, $id_kriteria, $matrix_id)) {
        $this->session->set_flashdata('messagematrix', 'Data matrix dengan ID Karyawan dan Kriteria tersebut sudah ada.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
        redirect('auth/tampil_matrix');
        return;
    }
    $data = array(
        'Nilai' => $this->input->post('nilai_matrix')
    );
    $result = $this->Mtopsis->updateMatrix($matrix_id, $data);
    if ($result) {
        $this->session->set_flashdata('messagematrix', 'Data matrix berhasil diupdate.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
    } else {
        $this->session->set_flashdata('messagematrix', 'Gagal mengupdate data matrix.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
    }
    redirect('auth/tampil_matrix');
  } 
  public function deleteKaryawan($karyawan_id) {
    $result = $this->Mtopsis->deleteKaryawan($karyawan_id);
    if ($result) {
        $this->session->set_flashdata('messagekaryawan', 'Data karyawan berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
    } else {
        $this->session->set_flashdata('messagekaryawan', 'Gagal menghapus data karyawan. Data karyawan sedang digunakan di tabel matrix.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
    }
    redirect('auth/tampil_karyawan');
  }
  public function deleteKriteria($kriteria_id) {
    $isUsedInMatrix = $this->Mtopsis->checkKriteriaUsageInMatrix($kriteria_id);
    $isUsedInBobotNormalisasi = $this->Mtopsis->checkKriteriaUsageInBobotNormalisasi($kriteria_id);

    if (!$isUsedInMatrix && !$isUsedInBobotNormalisasi) {
        $result = $this->Mtopsis->deleteKriteria($kriteria_id);

        if ($result) {
            $this->session->set_flashdata('messagekriteria', 'Data kriteria berhasil dihapus. <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>');
        } else {
            $this->session->set_flashdata('messagekriteria', 'Gagal menghapus data kriteria.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>');
        }
    } else {
        $this->session->set_flashdata('messagekriteria', 'Gagal menghapus data kriteria. Data kriteria sedang digunakan di tabel matrix atau bobot normalisasi.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>');
    }

    redirect('auth/tampil_kriteria');
  }
  public function deleteMatrix($matrix_id) {
    $result = $this->Mtopsis->deleteMatrix($matrix_id);
    if ($result) {
        $this->session->set_flashdata('messagematrix', 'Data  berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
    } else {
        $this->session->set_flashdata('messagematrix', 'Gagal menghapus data matrix.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>');
    }
    redirect('auth/tampil_matrix');
  }
  public function tampilHasil()
  {
    if (!$this->session->userdata('username')) {
      redirect('auth');
    }
    $this->load->model('Mtopsis');
    $normalizedMatrix = $this->Mtopsis->getNormalizedMatrix();
    $data['matrixTerbobot'] = $this->Mtopsis->matrixTerbobot();
    $this->load->view('admin/dashboard/header');
    $this->load->view('admin/dashboard/sidebar');
    $this->load->view('admin/data/tampilnormalisasi', ['normalizedMatrix' => $normalizedMatrix, 'matrixTerbobot' => $data['matrixTerbobot']]);
    $this->load->view('admin/dashboard/footer');
  }  

  public function tampilIdeal(){
    if (!$this->session->userdata('username')) {
      redirect('auth');
    }
    $data['matrixTerbobot'] = $this->Mtopsis->matrixTerbobot();
    $data['idealPositif'] = $this->Mtopsis->idealPositif();
    $data['idealNegatif'] = $this->Mtopsis->idealNegatif();
    $this->load->view('admin/dashboard/header');
    $this->load->view('admin/dashboard/sidebar');
    $this->load->view('admin/data/tampiltitikideal', $data);
    $this->load->view('admin/dashboard/footer');
  }
  public function tampilJarakKaryawan()
  {
    if (!$this->session->userdata('username')) {
      redirect('auth');
    }
    $jarakSetiapKaryawan = $this->Mtopsis->jarakIdealPositif();
    $data['jarakSetiapKaryawan'] = $jarakSetiapKaryawan;
    $jarakSetiapKaryawan = $this->Mtopsis->jarakIdealNegatif();
    $data['jarakNegatifSetiapKaryawan'] = $jarakSetiapKaryawan;
    $this->load->view('admin/dashboard/header');
    $this->load->view('admin/dashboard/sidebar');
    $this->load->view('admin/data/tampiljarakideal', $data);
    $this->load->view('admin/dashboard/footer');
  }
  public function tampilNilaiPreferensiDanPeringkat()
  {
    if (!$this->session->userdata('username')) {
      redirect('auth');
    }
    $nilaiPreferensiSetiapKaryawan = $this->Mtopsis->hitungNilaiPreferensiSetiapKaryawan();
    $data['nilaiPreferensiSetiapKaryawan'] = $nilaiPreferensiSetiapKaryawan;
    $peringkatKaryawan = $this->Mtopsis->peringkatKaryawan();
    $data['peringkatKaryawan'] = $peringkatKaryawan;
    $this->load->view('admin/dashboard/header');
    $this->load->view('admin/dashboard/sidebar');
    $this->load->view('admin/data/tampilnilaipreferensidanperingkat', $data);
    $this->load->view('admin/dashboard/footer');
  }

 public function tampilPerbandingan(){
  if (!$this->session->userdata('username')) {
    redirect('auth');
  }
  $data['kriteria'] = $this->Mtopsis->getKriteriaData();
  $integritas = $this->Mtopsis->getIntegritasData();
  $data['integritas'] = $integritas;
  $this->load->view('admin/dashboard/header');
  $this->load->view('admin/dashboard/sidebar');
  $this->load->view('admin/data/tampilPerbandingan',$data);
  $this->load->view('admin/dashboard/footer');
}

public function insertIntegritas() {
  $data = array(
      'nilai_integritas' => $this->input->post('nilai_integritas'),
      'definisi' => $this->input->post('definisi'),
  );
  $id_integritas = $this->Mtopsis->insertIntegritas($data);
  if ($id_integritas) {
      $this->session->set_flashdata('messageintegritas', 
        'Data Integritas berhasil ditambahkan dengan ID: ' . $id_integritas . '
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>');
  } else {
      $this->session->set_flashdata('messageintegritas', 'Gagal menambahkan data integritas.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>');
  }
  redirect('auth/tampilPerbandingan');
}
public function editIntegritasForm($id_integritas) {
  if (!$this->session->userdata('username')) {
    redirect('auth');
  }
  $data['integritas'] = $this->Mtopsis->getIntegritasById($id_integritas);
  $this->load->view('admin/dashboard/header');
  $this->load->view('admin/dashboard/sidebar');
  $this->load->view('admin/edit/editintegritas', $data); 
  $this->load->view('admin/dashboard/footer');
}
public function updateIntegritas($id_integritas) {
  $data = array(
    'nilai_integritas' => $this->input->post('nilai_integritas'),
      'definisi' => $this->input->post('definisi'),
   
  );
  $result = $this->Mtopsis->updateIntegritas($id_integritas, $data);
if ($result) {
    $this->session->set_flashdata('messageintegritas', 
      'Data Integritas berhasil di update
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>');
} else {
    $this->session->set_flashdata('messageintegritas', 'Gagal mengUpdate.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>');
}
  redirect('auth/tampilPerbandingan');
}
public function deleteIntegritas($id_integritas) {
  $result = $this->Mtopsis->deleteIntegritas($id_integritas);
  if ($result) {
      $this->session->set_flashdata('messageintegritas', 'Data integritas berhasil dihapus.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>');
  } else {
      $this->session->set_flashdata('messageintegritas', 'Gagal menghapus data integritas..
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>');
  }
  redirect('auth/tampilPerbandingan');
}
}
?>