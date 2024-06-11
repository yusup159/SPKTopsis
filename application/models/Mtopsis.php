<?php
class Mtopsis extends CI_Model
{


    public function cek_login($u, $p)
    {
        $q = $this->db->get_where('admin', array('username ' => $u, 'password' => $p));
        return $q;
    }
    public function getKaryawanData()
    {
        return $this->db->get('karyawan')->result();
    }
    public function getKriteriaData()
    {
        return $this->db->get('kriteria')->result();
    }
    public function getMatrixData()
    {
        $this->db->select('Matrix.*, Karyawan.NamaKaryawan, Kriteria.NamaKriteria');
        $this->db->from('Matrix');
        $this->db->join('Karyawan', 'Karyawan.ID_Karyawan = Matrix.ID_Karyawan');
        $this->db->join('Kriteria', 'Kriteria.ID_Kriteria = Matrix.ID_Kriteria');
        return $this->db->get()->result();
    }
    public function insertKaryawan($data)
    {
        $this->db->insert('Karyawan', $data);
        return $this->db->insert_id();
    }
    public function getKaryawanById($karyawan_id)
    {
        return $this->db->get_where('Karyawan', array('ID_Karyawan' => $karyawan_id))->row();
    }
    public function updateKaryawan($karyawan_id, $data)
    {
        $this->db->where('ID_Karyawan', $karyawan_id);
        return $this->db->update('Karyawan', $data);
    }
    public function insertKriteria($data)
    {
        $this->db->insert('Kriteria', $data);
        return $this->db->insert_id();
    }
    public function getKriteriaById($kriteria_id)
    {
        return $this->db->get_where('Kriteria', array('ID_Kriteria' => $kriteria_id))->row();
    }
    public function updateKriteria($kriteria_id, $data)
    {
        $this->db->where('ID_Kriteria', $kriteria_id);
        return $this->db->update('Kriteria', $data);
    }
    public function getKaryawanByName($nama_karyawan)
    {
        $this->db->like('NamaKaryawan', $nama_karyawan);
        return $this->db->get('Karyawan')->result();
    }
    public function getKriteriaByName($nama_kriteria)
    {
        $this->db->like('NamaKriteria', $nama_kriteria);
        return $this->db->get('Kriteria')->result();
    }
    public function insertMatrix($data)
    {
        $this->db->insert('Matrix', $data);
        return $this->db->insert_id();
    }
    public function getMatrixById($matrix_id)
    {
        return $this->db->get_where('Matrix', array('ID_Matrix' => $matrix_id))->row();
    }
    public function updateMatrix($matrix_id, $data)
    {
        $this->db->where('ID_Matrix', $matrix_id);
        $result = $this->db->update('matrix', array('Nilai' => $data['Nilai']));
        return $result;
    }
    public function checkKaryawanUsage($karyawan_id)
    {
        $this->db->where('ID_Karyawan', $karyawan_id);
        $result = $this->db->get('Matrix')->row();

        return ($result) ? true : false;
    }
    public function deleteKaryawan($karyawan_id)
    {
        if (!$this->checkKaryawanUsage($karyawan_id)) {
            $this->db->where('ID_Karyawan', $karyawan_id);
            return $this->db->delete('karyawan');
        } else {
            return false;
        }
    }
    public function checkKriteriaUsageInMatrix($kriteria_id)
    {
        $this->db->where('ID_Kriteria', $kriteria_id);
        $result = $this->db->get('Matrix')->row();
        return ($result) ? true : false;
    }

    public function deleteKriteria($kriteria_id)
    {
        $isUsedInMatrix = $this->checkKriteriaUsageInMatrix($kriteria_id);


        if (!$isUsedInMatrix) {
            $this->db->where('ID_Kriteria', $kriteria_id);
            return $this->db->delete('kriteria');
        } else {
            return false;
        }
    }
    public function deleteMatrix($matrix_id)
    {
        $this->db->where('ID_Matrix', $matrix_id);
        return $this->db->delete('Matrix');
    }
    public function isMatrixExists($id_karyawan, $id_kriteria)
    {
        $this->db->where('ID_Karyawan', $id_karyawan);
        $this->db->where('ID_Kriteria', $id_kriteria);
        $query = $this->db->get('matrix');
        return $query->num_rows() > 0;
    }
    public function nilaiMatrixExists($id_karyawan, $id_kriteria, $matrix_id)
    {
        $this->db->where('ID_Karyawan', $id_karyawan);
        $this->db->where('ID_Kriteria', $id_kriteria);
        $this->db->where('ID_Matrix !=', $matrix_id);
        $query = $this->db->get('matrix');
        return $query->num_rows() > 0;
    }
    public function getPembagi($kriteria_id)
    {
        $this->db->select_sum('pow(Nilai, 2)', 'pembagi');
        $this->db->where('ID_Kriteria', $kriteria_id);
        $result = $this->db->get('matrix')->row();
        return $result->pembagi;
    }
    public function getMatrixDataNormalisasi()
    {
        $this->db->select('*');
        $this->db->from('matrix');
        $this->db->join('karyawan', 'karyawan.ID_Karyawan = matrix.ID_Karyawan');
        $this->db->join('kriteria', 'kriteria.ID_Kriteria = matrix.ID_Kriteria');
        $query = $this->db->get();
        return $query->result();
    }
    public function getKriteriaByIdNormalisasi($id, $kriteriaData)
    {
        foreach ($kriteriaData as $kriteria) {
            if ($kriteria->ID_Kriteria == $id) {
                return $kriteria;
            }
        }
        return null;
    }
    public function getKriteria()
    {
        return $this->db->get('kriteria')->result();
    }
    public function getNormalizedMatrix()
    {
        $matrixData = $this->getMatrixDataNormalisasi();
        $kriteriaData = $this->getKriteria();
        $normalizedMatrix = [];
        foreach ($matrixData as $row) {
            $pembagi = $this->getPembagi($row->ID_Kriteria);
            $normalisasi = $row->Nilai / sqrt($pembagi);
            if (!isset($normalizedMatrix[$row->ID_Karyawan])) {
                $normalizedMatrix[$row->ID_Karyawan] = [
                    'ID_Karyawan' => $row->ID_Karyawan,
                    'NamaKaryawan' => $row->NamaKaryawan,
                    'Jabatan' => $row->Jabatan,
                    'Alamat' => $row->Alamat,
                    'GajiSaatIni' => $row->GajiSaatIni,
                    'values' => [],
                ];
            }
            $kriteria = $this->getKriteriaByIdNormalisasi($row->ID_Kriteria, $kriteriaData);
            $normalizedMatrix[$row->ID_Karyawan]['values'][] = [
                'ID_Kriteria' => $kriteria->ID_Kriteria,
                'NamaKriteria' => $kriteria->NamaKriteria,
                'Nilai' => $normalisasi,
            ];
        }

        return array_values($normalizedMatrix);
    }

    public function matrixTerbobot()
    {
        $kriteriaData = $this->getKriteria();
        $normalisasi = $this->getNormalizedMatrix();
        $hasil = [];
        foreach ($normalisasi as $key => $row) {
            $hasil[$key] = $row;
            foreach ($row['values'] as $index => $nilai) {
                $kriteria = $this->getKriteriaByIdNormalisasi($nilai['ID_Kriteria'], $kriteriaData);
                $hasil[$key]['values'][$index]['BobotTerbobot'] = $kriteria->BobotKriteria * $nilai['Nilai'];
            }
        }
        return $hasil;
    }
    public function idealPositif()
    {
        $matrixTerbobot = $this->matrixTerbobot();
        $kriteriaBenefit = $this->db->where('Status', 'BENEFIT')->get('kriteria')->result();
        $kriteriaCost = $this->db->where('Status', 'COST')->get('kriteria')->result();
        $idealPositif = [];
        foreach ($kriteriaBenefit as $kriteria) {
            $maxValue = 0;
            $maxKaryawan = [];
            foreach ($matrixTerbobot as $row) {
                foreach ($row['values'] as $nilai) {
                    if ($nilai['ID_Kriteria'] == $kriteria->ID_Kriteria && $nilai['BobotTerbobot'] > $maxValue) {
                        $maxValue = $nilai['BobotTerbobot'];
                        $maxKaryawan = $row;
                    }
                }
            }
            $idealPositif[] = [
                'Kriteria' => $kriteria->NamaKriteria,
                'IdealPositif' => $maxKaryawan,
                'NilaiBobotTerbobot' => $maxValue,
            ];
        }
        foreach ($kriteriaCost as $kriteria) {
            $minValue = PHP_INT_MAX;
            $minKaryawan = [];
            foreach ($matrixTerbobot as $row) {
                foreach ($row['values'] as $nilai) {
                    if ($nilai['ID_Kriteria'] == $kriteria->ID_Kriteria && $nilai['BobotTerbobot'] < $minValue) {
                        $minValue = $nilai['BobotTerbobot'];
                        $minKaryawan = $row;
                    }
                }
            }
            $idealPositif[] = [
                'Kriteria' => $kriteria->NamaKriteria,
                'IdealPositif' => $minKaryawan,
                'NilaiBobotTerbobot' => $minValue,
            ];
        }
        return $idealPositif;
    }
    public function idealNegatif()
    {
        $matrixTerbobot = $this->matrixTerbobot();
        $kriteriaBenefit = $this->db->where('Status', 'BENEFIT')->get('kriteria')->result();
        $kriteriaCost = $this->db->where('Status', 'COST')->get('kriteria')->result();
        $idealNegatif = [];
        foreach ($kriteriaBenefit as $kriteria) {
            $minValue = PHP_INT_MAX;
            $minKaryawan = [];
            foreach ($matrixTerbobot as $row) {
                foreach ($row['values'] as $nilai) {
                    if ($nilai['ID_Kriteria'] == $kriteria->ID_Kriteria && $nilai['BobotTerbobot'] < $minValue) {
                        $minValue = $nilai['BobotTerbobot'];
                        $minKaryawan = $row;
                    }
                }
            }
            $idealNegatif[] = [
                'Kriteria' => $kriteria->NamaKriteria,
                'IdealNegatif' => $minKaryawan,
                'NilaiBobotTerbobot' => $minValue,
            ];
        }
        foreach ($kriteriaCost as $kriteria) {
            $maxValue = 0;
            $maxKaryawan = [];
            foreach ($matrixTerbobot as $row) {
                foreach ($row['values'] as $nilai) {
                    if ($nilai['ID_Kriteria'] == $kriteria->ID_Kriteria && $nilai['BobotTerbobot'] > $maxValue) {
                        $maxValue = $nilai['BobotTerbobot'];
                        $maxKaryawan = $row;
                    }
                }
            }
            $idealNegatif[] = [
                'Kriteria' => $kriteria->NamaKriteria,
                'IdealNegatif' => $maxKaryawan,
                'NilaiBobotTerbobot' => $maxValue,
            ];
        }
        return $idealNegatif;
    }
    public function jarakIdealPositif()
    {
        $idealPositif = $this->idealPositif();
        $matrixTerbobot = $this->matrixTerbobot();
        $jarakSetiapKaryawan = [];
        foreach ($matrixTerbobot as $row) {
            $jarak = 0;
            foreach ($row['values'] as $index => $nilai) {
                $idealValue = 0;
                foreach ($idealPositif as $ideal) {
                    if ($ideal['Kriteria'] == $nilai['NamaKriteria']) {
                        $idealValue = $ideal['NilaiBobotTerbobot'];
                        break;
                    }
                }
                $jarak += pow($nilai['BobotTerbobot'] - $idealValue, 2);
            }
            $totalJarak = sqrt($jarak);
            $jarakSetiapKaryawan[] = [
                'ID_Karyawan' => $row['ID_Karyawan'],
                'NamaKaryawan' => $row['NamaKaryawan'],
                'JarakIdealPositif' => $totalJarak,
            ];
        }
        return $jarakSetiapKaryawan;
    }
    public function jarakIdealNegatif()
    {
        $idealNegatif = $this->idealNegatif();
        $matrixTerbobot = $this->matrixTerbobot();
        $jarakSetiapKaryawan = [];
        foreach ($matrixTerbobot as $row) {
            $jarak = 0;
            foreach ($row['values'] as $index => $nilai) {
                $idealValue = 0;
                foreach ($idealNegatif as $ideal) {
                    if ($ideal['Kriteria'] == $nilai['NamaKriteria']) {
                        $idealValue = $ideal['NilaiBobotTerbobot'];
                        break;
                    }
                }
                $jarak += pow($nilai['BobotTerbobot'] - $idealValue, 2);
            }
            $totalJarak = sqrt($jarak);
            $jarakSetiapKaryawan[] = [
                'ID_Karyawan' => $row['ID_Karyawan'],
                'NamaKaryawan' => $row['NamaKaryawan'],
                'JarakIdealNegatif' => $totalJarak,
            ];
        }
        return $jarakSetiapKaryawan;
    }
    public function hitungNilaiPreferensiSetiapKaryawan()
    {
        $jarakIdealPositif = $this->jarakIdealPositif();
        $jarakIdealNegatif = $this->jarakIdealNegatif();
        $nilaiPreferensiSetiapKaryawan = [];
        foreach ($jarakIdealNegatif as $key => $karyawanNegatif) {
            $karyawanPositif = $jarakIdealPositif[$key];
            $nilaiPreferensi = 0;
            if (($karyawanNegatif['JarakIdealNegatif'] + $karyawanPositif['JarakIdealPositif']) != 0) {
                $nilaiPreferensi = $karyawanNegatif['JarakIdealNegatif'] / ($karyawanNegatif['JarakIdealNegatif'] + $karyawanPositif['JarakIdealPositif']);
            }
            $nilaiPreferensiSetiapKaryawan[] = [
                'ID_Karyawan' => $karyawanNegatif['ID_Karyawan'],
                'NamaKaryawan' => $karyawanNegatif['NamaKaryawan'],
                'NilaiPreferensi' => $nilaiPreferensi,
            ];
        }
        return $nilaiPreferensiSetiapKaryawan;
    }
    public function peringkatKaryawan()
    {
        $nilaiPreferensiSetiapKaryawan = $this->hitungNilaiPreferensiSetiapKaryawan();
        usort($nilaiPreferensiSetiapKaryawan, function ($a, $b) {
            return $b['NilaiPreferensi'] <=> $a['NilaiPreferensi'];
        });
        $peringkat = 1;
        foreach ($nilaiPreferensiSetiapKaryawan as &$karyawan) {
            $karyawan['Peringkat'] = $peringkat;
            $peringkat++;
        }
        return $nilaiPreferensiSetiapKaryawan;
    }

    public function getIntegritasData()
    {
        return $this->db->get('integritas')->result();
    }

    public function insertIntegritas($data)
    {
        $this->db->insert('integritas', $data);
        return $this->db->insert_id();
    }
    public function getIntegritasById($id_integritas)
    {
        return $this->db->get_where('integritas', array('id_integritas' => $id_integritas))->row();
    }
    public function updateIntegritas($id_integritas, $data)
    {
        $this->db->where('id_integritas', $id_integritas);
        return $this->db->update('integritas', $data);
    }
    public function deleteIntegritas($id_integritas)
    {

        $this->db->where('id_integritas', $id_integritas);
        return $this->db->delete('integritas');
    }
    public function insertPerbandinganKriteria($data)
    {
        $this->db->insert('perbandingankriteria', $data);
    }

    public function getPerbandinganKriteria()
    {
        $this->db->select('*');
        $this->db->from('perbandingankriteria');
        $query = $this->db->get();
        return $query->result();
    }
    public function update_bobot($id_kriteria, $bobot)
    {
        $data = array(
            'BobotKriteria' => $bobot
        );
        $this->db->where('ID_Kriteria', $id_kriteria);
        $this->db->update('kriteria', $data);
    }
}
