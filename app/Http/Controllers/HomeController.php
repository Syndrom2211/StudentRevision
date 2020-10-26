<?php
// Query Builder = DB::
// Eloquent ORM  = User::

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

//dari model
use App\User;
use App\Proposalku;
use App\Proposalku_revisi;
use App\Komentar;
use App\DataMahasiswa;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $hasil = DataMahasiswa::all();   
        $hasil2 = Proposalku::all();
        
        return view('home', compact(['hasil','hasil2']));
    }
    
    public function pengaturan_mhs($id)
    {
        $hasil = User::where('id', '=', $id)->take(1)->get();
        return view('pengaturan_mhs', ['liat'=>$hasil]);
    }
    
    public function pengaturan_mhs_ubah($id){
        $hasil = User::where('id', '=', $id)->take(1)->get();
        return view('pengaturan_mhs_ubah', ['liat'=>$hasil]);
    }

    public function pengaturan_mhs_ubah_proses(Request $request){
        $edit = new user;
        $edit->id               = $request->id_user;
        $edit->name             = $request->nama;
        $edit->email            = $request->email;
        $edit->password         = $request->password;
        
        // update data proposal
        DB::table('users')->where('id',$request->id_user)->update([
            'id' => $edit->id,
            'name' => $edit->name,
            'email' => $edit->email,
            'password' => bcrypt($edit->password)
        ]);
        
        // alihkan halaman ke halaman proposal
        return redirect('/pengaturan_mhs/'.$edit->id);
    }
    
    //----Upload Proposal
    public function upload_proposal()
    {
        //$hasil = DataMahasiswa::all();
        //$hasil = DB::table('mhs_bimbingan')
        //        ->join('users', 'users.id', '=', 'mhs_bimbingan.id')
        //        ->select('mhs_bimbingan.*', 'users.*')
        //        ->get();
        
        $hasil = DataMahasiswa::all();
        $hasil2 = DB::table('mhs_bimbingan')
                ->join('users', 'users.id', '=', 'mhs_bimbingan.id_pembimbing')
                ->select('mhs_bimbingan.*', 'users.*')
                ->get();
        
        return view('upload_proposal', compact(['hasil','hasil2']));
        
        //return view('upload_proposal', ['liat'=>$hasil]);
    }
    
    public function upload_proposal_proses(Request $request)
    {
        $this->validate($request, [
			'file' => 'required|mimes:doc,docx',
			'keterangan' => 'required',
		]);
        
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
        
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'dokumen_proposal';

        // upload file
		$file->move($tujuan_upload, preg_replace("/\s+/","",$file->getClientOriginalName()));
        
        //---ke database---
        $tambah = new proposalku;
        
        $tambah->id_proposal    = $request->id_proposal;
        $tambah->nama_dokumen   = $file->getClientOriginalName();
        $tambah->id_mahasiswa   = $request->id_mahasiswa;
        $tambah->tipe_dokumen   = $file->getClientOriginalExtension();
        $tambah->link_dokumen   = $tujuan_upload."/".$file->getClientOriginalName();
        $tambah->keterangan     = $request->keterangan;
        
        $tambah->save();
        //$ya = preg_replace("/\s+/","",$file->getClientOriginalName());
        
        //$a = shell_exec("C:\Python38-32\python ". app_path() . "\http\controllers\PythonScript\get_comment.py C:\wamp64\www\sistem_cerdas\public\dokumen_proposal\\".$ya);
        
        /*
        $tampung = explode("\n",$a);
        for ($x = 0; $x <= count($tampung)-1; $x++) {
            $tambah2 = new komentar;
            $tambah2->id_proposal = $request->id_proposal;
            $tambah2->id_pembimbing = $request->id_pembimbing;
            $tambah2->teks_komentar = $tampung[$x];
            $tambah2->kategori_komentar = "content-related";
            $tambah2->tgl_komentar = "2020-07-29";
            $tambah2->save();
        }*/         
        
        return redirect('/proposalku/'.$request->id_mahasiswa);
    }
    //----Upload Proposal
    
    public function proposalku($id)
    {
        $hasil = Proposalku::where('id_mahasiswa', '=', $id)->take(1)->get();
        //$hasil = DB::table('dokumen_proposals')
        //            ->where('id_mahasiswa', '=', $id)
        //            ->get();
        
        return view('proposalku', ['liat'=>$hasil]);
    }
    
    public function edit_proposalku($id_proposal){
        $hasil = Proposalku::find($id_proposal);
        return view('proposalku_ubah', ['proposalku'=>$hasil]);
    }
    
    public function edit_proposalku_ubah(Request $request){
        $this->validate($request, [
			'file' => 'required|mimes:doc,docx',
			'keterangan' => 'required',
		]);
        
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
        
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'dokumen_proposal';

        // upload file
		$file->move($tujuan_upload,$file->getClientOriginalName());
        
        //---ke database---
        $edit = new proposalku;
        $edit->nama_dokumen   = $file->getClientOriginalName();
        $edit->id_mahasiswa   = $request->id_mahasiswa;
        $edit->tipe_dokumen   = $file->getClientOriginalExtension();
        $edit->link_dokumen   = $tujuan_upload."/".$file->getClientOriginalName();
        $edit->keterangan     = $request->keterangan;
        
        // update data proposal
        DB::table('dokumen_proposals')->where('id_proposal',$request->id_proposal)->update([
            'id_mahasiswa' => $edit->id_mahasiswa,
            'nama_dokumen' => $edit->nama_dokumen,
            'tipe_dokumen' => $edit->tipe_dokumen,
            'link_dokumen' => $edit->link_dokumen,
            'keterangan' => $edit->keterangan
        ]);
        
        // alihkan halaman ke halaman proposal
        return redirect('/proposalku/'.$edit->id_mahasiswa);
    }
    
    public function hapus_proposalku($id_proposal){
        // menghapus data proposal berdasarkan id proposal yang dipilih
        DB::table('dokumen_proposals')->where('id_proposal',$id_proposal)->delete();
        
        // alihkan halaman ke halaman proposalku
        return redirect('/');
    }
    
    public function lihat_komentar($id_proposal)
    {
        //$hasil = Komentar::all()->where('id_proposal', $id_proposal);
        $hasil = DB::table('komentar_proposal')
                ->join('dokumen_proposals', 'dokumen_proposals.id_proposal', '=', 'komentar_proposal.id_proposal')
                ->join('users', 'users.id', '=', 'komentar_proposal.id_pembimbing')
                ->select('dokumen_proposals.*', 'komentar_proposal.*', 'users.*')
                ->get();
        return view('proposalku_komentar', ['liat'=>$hasil]);
    }
    
    public function data_mhs_bimbingan()
    {
            $hasil = DB::table('mhs_bimbingan')
                //->rightJoin('users', 'mhs_bimbingan.id_pembimbing', '=', 'users.id')
                //->where('level', '=', 'mahasiswa')
                //->get();
        
                ->join('users', 'users.id', '=', 'mhs_bimbingan.id')
                ->select('users.*', 'mhs_bimbingan.*')
                ->get();
            return view('data_mhs_bimbingan', ['liat'=>$hasil]);
    }
    
    public function tambah_data_mhs_bimbingan()
    {        
        $hasil = User::where('level', '=', 'mahasiswa')->get();
        //$hasil = Proposalku::where('level', '=', 'mahasiswa')->get();
        
        //$hasil = DB::table('dokumen_proposals')
        //         ->join('users', 'users.id', '=', 'dokumen_proposals.id_mahasiswa')
        //         ->select('users.*', 'dokumen_proposals.*')
        //         ->get();
        
        return view('tambah_data_mhs_bimbingan', ['liat'=>$hasil]);
    }
    
    public function edit_data_mhs_bimbingan($id_mhs_bimbingan){
        $hasil = DataMahasiswa::find($id_mhs_bimbingan);
        $hasil2 = User::where('level', '=', 'mahasiswa')->get();
        
        return view('edit_data_mhs_bimbingan', compact(['hasil','hasil2']));
    }
    
    public function proses_tambah_data_mhs_bimbingan(Request $request){
        //---ke database---
        $tambah = new datamahasiswa;
        $tambah->id_pembimbing  = $request->id_pembimbing;
        $tambah->id             = $request->mahasiswa;
        $tambah->status_revisi  = $request->status_revisi;
        
        $tambah->save();
        return redirect('/data_mhs_bimbingan');
    }    
    
    public function edit_data_mhs_bimbingan_proses(Request $request){
        //---ke database---
        $edit = new datamahasiswa;
        $edit->id_pembimbing    = $request->id_pembimbing;
        $edit->mahasiswa        = $request->mahasiswa;
        
        // update data proposal
        DB::table('mhs_bimbingan')->where('id_mhs_bimbingan',$request->id_mhs_bimbingan)->update([
            'id_mhs_bimbingan' => $edit->id_pembimbing,
            'id' => $edit->mahasiswa
        ]);
        
        // alihkan halaman ke halaman proposal
        return redirect('/data_mhs_bimbingan');
    }
    
    public function proses_notifikasi_revisi(Request $request){
        //---ke database---
        $edit = new datamahasiswa;
        
        if ($request->update_status == 'Belum Revisi')
            $edit->status_revisi        = 'Sudah Revisi';
        elseif ($request->update_status == 'Sudah Revisi')
            $edit->status_revisi        = 'Belum Revisi';
        
        // update data proposal
        DB::table('mhs_bimbingan')->where('id_mhs_bimbingan',$request->id_mhs_bimbingan)->update([
            'status_revisi' => $edit->status_revisi
        ]);
        
        // alihkan halaman ke halaman proposal
        return redirect('/data_mhs_bimbingan');
    }
    
    public function petunjuk_revisi($id_komentar)
    {
        //$hasil = Komentar::all()->where('id_proposal', $id_proposal);
        $hasil = DB::table('petunjuk_revisi')
                ->join('komentar_proposal', 'komentar_proposal.id_komentar', '=', 'petunjuk_revisi.id_komentar')
                ->select('petunjuk_revisi.*', 'komentar_proposal.*')
                ->get();
        return view('petunjuk_revisi', ['liat'=>$hasil]);
    }

    public function proposal_mhs_bimbingan()
    {
        //join antara tabel mhs_bimbingan dan dokumen_proposal (untuk ambil data proposalnya)
        $hasil = DB::table('mhs_bimbingan')
                ->join('dokumen_proposals', 'dokumen_proposals.id_mahasiswa', '=', 'mhs_bimbingan.id')
                ->select('mhs_bimbingan.*', 'dokumen_proposals.*')
                ->get();
        return view('proposal_mhs_bimbingan', ['liat'=>$hasil]);
    }

    public function upload_proposal_revisi_proses(Request $request)
    {
        $this->validate($request, [
			'file' => 'required|mimes:doc,docx',
		]);
        
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
        
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'dokumen_proposal';

        // upload file
		$file->move($tujuan_upload, preg_replace("/\s+/","",$file->getClientOriginalName()));
        
        //---ke database---
        $tambah = new proposalku_revisi;
        
        $tambah->id_revisi      = $request->id_revisi;
        $tambah->id_proposal    = $request->id_proposal;
        $tambah->nama_dokumen   = $file->getClientOriginalName();
        $tambah->id_mahasiswa   = $request->id_mahasiswa;
        $tambah->tipe_dokumen   = $file->getClientOriginalExtension();
        $tambah->link_dokumen   = $tujuan_upload."/".$file->getClientOriginalName();
        $tambah->catatan_pembimbing     = $request->catatan_pembimbing;
        
        $tambah->save();
        $ya = preg_replace("/\s+/","",$file->getClientOriginalName());
        
        $a = shell_exec("C:\Python-27\python ". app_path() . "\http\controllers\PythonScript\get_comment.py C:\wamp64\www\sistem_cerdas\public\dokumen_proposal\\".$ya);
        
        $tampung = explode("\n",$a);
        for ($x = 0; $x <= count($tampung)-1; $x++) {
            $tambah2 = new komentar;
            $tambah2->id_proposal = $request->id_proposal;
            $tambah2->id_pembimbing = $request->id_pembimbing;
            $tambah2->teks_komentar = $tampung[$x];
            $tambah2->kategori_komentar = "content-related";
            $tambah2->tgl_komentar = "2020-07-29";
            $tambah2->save();
        }            
        
        return redirect('/upload_proposal_revisi/'.$request->id_pembimbing);
    }

    public function upload_proposal_revisi()
    {        
        //di join kan dengan tabel mahasiswa bimbingan untuk ambil id pembimbing nya
        //where level mahasiswa and id pembimbing sama dengan yang login/berelasi

        //$hasil = User::where('level', '=', 'mahasiswa')->get();
        //return view('upload_proposal_revisi', ['liat'=>$hasil]);    
        
        $hasil = DB::table('users')
                ->join('mhs_bimbingan', 'mhs_bimbingan.id', '=', 'users.id')
                ->join('dokumen_proposals', 'dokumen_proposals.id_mahasiswa', '=', 'users.id')
                ->select('users.*', 'mhs_bimbingan.*', 'dokumen_proposals.*')
                ->where('users.level', '=', 'mahasiswa')
                ->get();

        return view('upload_proposal_revisi', ['liat'=>$hasil]);
    }
}