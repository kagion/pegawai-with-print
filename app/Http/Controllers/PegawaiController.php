<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Exception;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class PegawaiController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'nip' => ['required', 'integer', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image'],
            'email' => ['required', 'email', 'unique:pegawais'],
            'section' => ['required', 'string'],
            'blood_group' => ['required', 'string', 'max:3'],
            'mobile_no' => ['required', 'string'],
            'current_address' => ['required']
        ]);

        if ($request->hasfile("image")) {
            $pegawaiImage = uniqid(11) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('pegawais\images'), $pegawaiImage);
        }

        $data = [
            "nip" => $request->nip,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "image" => $pegawaiImage,
            "email" => $request->email,
            "section" => $request->section,
            "blood_group" => $request->blood_group,
            "mobile_no" => $request->mobile_no,
            "current_address" => $request->current_address,
        ];

        if (Pegawai::insert($data)) {
            return back()->with('success', 'Pegawai added successfully.');
        } else {
            return back()->with('error', 'Terjadi kesalahan!');
        }
    }

    public function storeBulk(Request $request)
    {
        $this->validate($request, [
            'excel' => ['required', 'file']
        ]);
        $reader = new Xlsx();
        $spreadsheet = $reader->load($request->file('excel'));
        $rows = array();
        $images = $this->getImages($spreadsheet);
        $worksheet = $spreadsheet->getActiveSheet();
        foreach ($worksheet->getRowIterator() as $index => $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            $row = [];
            foreach ($cellIterator as $cell) {
                $row[] = $cell->getValue();
            }
            if (empty($row[1])) {
                break;
            }
            $row["index"] = $index;
            $rows[] = $row;
        }
        foreach ($rows as $index => $row) {
            foreach ($images as $image) {
                preg_match_all('!\d+!', $image["cordinate"], $matches);
                if ($row["index"] == (int)implode("", $matches[0])) {
                    $rows[$index] = array_merge($row, $image);
                    break;
                }
            }
        }
        array_splice($rows, 0, 1);
        $i = 0;
        foreach ($rows as $row) {
            if (array_key_exists("image", $row)) {
                $name = uniqid(11) . '.' . $row["extension"];
                file_put_contents("pegawais/images/" . $name, $row["image"]);
            }

            $data = [
                "nip" => $row[0],
                "first_name" => $row[0],
                "last_name" => $row[1],
                "image" => array_key_exists("image", $row) ? $name : null,
                "email" => $row[2],
                "section" => $row[5],
                "blood_group" => $row[6],
                "mobile_no" => $row[7],
                "current_address" => $row[8],
            ];
            try {
                Pegawai::insert($data);
            } catch (Exception $e) {
                $i++;
                continue;
            }
        }
        if ($i > 0) {
            return back()->with('warning', 'Some pegawai not added. Duplicate Data');
        }
        return back()->with('success', 'Pegawai berhasil ditambah.');
    }

    public function getImages($spreadsheet)
    {
        $images = [];
        // $i = 0;
        foreach ($spreadsheet->getActiveSheet()->getDrawingCollection() as $drawing) {
            if ($drawing instanceof \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing) {
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $imageContents = ob_get_contents();
                ob_end_clean();
                switch ($drawing->getMimeType()) {
                    case \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_PNG:
                        $extension = 'png';
                        break;
                    case \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_GIF:
                        $extension = 'gif';
                        break;
                    case \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_JPEG:
                        $extension = 'jpg';
                        break;
                }
            } else {
                $zipReader = fopen($drawing->getPath(), 'r');
                $imageContents = '';
                while (!feof($zipReader)) {
                    $imageContents .= fread($zipReader, 1024);
                }
                fclose($zipReader);
                $extension = $drawing->getExtension();
            }
            $images[] = [
                "extension" => $extension,
                "image" => $imageContents,
                "cordinate" => $drawing->getCoordinates()
            ];
        }
        return $images;
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $this->validate($request, [
            'nip' => ['required', 'integer', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:pegawais,email,' . $pegawai->id],
            'section' => ['required', 'string'],
            'blood_group' => ['required', 'string', 'max:3'],
            'mobile_no' => ['required', 'string'],
            'current_address' => ['required']
        ]);
        $pegawaiImage = null;
        if ($request->hasfile("image")) {
            $pegawaiImage = uniqid(11) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('pegawais\images'), $pegawaiImage);
        }

        $data = [
            "nip" => $request->nip,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "image" => $pegawaiImage ?: $pegawai->image,
            "email" => $request->email,
            "section" => $request->section,
            "blood_group" => $request->blood_group,
            "mobile_no" => $request->mobile_no,
            "current_address" => $request->current_address,
        ];

        if ($pegawai->update($data)) {
            return back()->with('success', 'pegawai updated successfully.');
        } else {
            return back()->with('error', 'Terjadi kesalahan yang tak terduga!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        if ($pegawai->delete()) {
            return back()->with('success', 'pegawai deleted successfully.');
        } else {
            return back()->with('error', 'Something went Wrong!');
        }
    }
}
