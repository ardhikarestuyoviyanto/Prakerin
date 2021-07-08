<?php

namespace App\Controllers;

use App\Models\Application;
use App\Models\ModelsAdmin;
use App\Models\Agenda;
use App\Models\Industri;
use Hermawan\DataTables\DataTable;

class Home extends BaseController{
	
	private $ModelsAdmin;
	private $ModelsApp;
	private $ModelsAgenda;
	private $ModelsIndustri;

	public function __construct(){
		$this->ModelsAdmin = new ModelsAdmin();
		$this->ModelsApp = new Application();
		$this->ModelsAgenda = new Agenda();
		$this->ModelsIndustri = new Industri();
		$this->input = service('request');

		view_cell('App\Libraries\Widgets::footer_home', ['app'=>$this->ModelsApp->getApp()->getResult()]);
		view_cell('App\Libraries\Widgets::js_home', ['app'=>$this->ModelsApp->getApp()->getResult()]);
	}

	public function index(){
		
		view_cell('App\Libraries\Widgets::head_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>null]);
		view_cell('App\Libraries\Widgets::navbar_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Beranda"]);

		$data = array(
			'data_app' => $this->ModelsApp->getApp()->getResultArray(),
			'banner' => $this->ModelsApp->getBanner()->getResultArray(),
			'agenda' => $this->ModelsApp->getAgendaLimit(3)->getResult()
		);

		return view('landingpage/landingpage', $data);
	
	}

	public function agenda(){

		view_cell('App\Libraries\Widgets::head_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>"Agenda"]);
		view_cell('App\Libraries\Widgets::navbar_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Agenda"]);

		if(isset($_GET['cari'])){

			$data = array(
				'kategori' => $this->ModelsAdmin->getKategoriAgenda()->getResult(),
				'agenda' => $this->ModelsApp->FilterAgenda(urldecode($_GET['cari']))->getResult(),
				'agendapopuler' => $this->ModelsApp->getAgendaLimit(5)->getResult(),
				'map' => urldecode($_GET['cari']),
				'pager' => null
			);

		}else{

			$data = array(
				'kategori' => $this->ModelsAdmin->getKategoriAgenda()->getResult(),
				'agenda' => $this->ModelsAgenda->paginate(8, 'agenda'),
				'agendapopuler' => $this->ModelsApp->getAgendaLimit(5)->getResult(),
				'map' => null,
				'pager' => $this->ModelsAgenda->pager
			);

		}

		return view('landingpage/agenda', $data);

	}

	public function kategoriagenda(){

		view_cell('App\Libraries\Widgets::head_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>urldecode($this->input->uri->getSegment('3'))]);
		view_cell('App\Libraries\Widgets::navbar_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Agenda"]);

		$data = array(
			'kategori' => $this->ModelsAdmin->getKategoriAgenda()->getResult(),
			'agenda' => $this->ModelsApp->getAgendaByNamaKategori(urldecode($this->input->uri->getSegment('3')))->getResult(),
			'agendapopuler' => $this->ModelsApp->getAgendaLimit(5)->getResult(),
			'map' => urldecode($this->input->uri->getSegment('3')),
			'pager' => null
		);

		return view('landingpage/agenda', $data);

	}

	public function bacaagenda(){

		view_cell('App\Libraries\Widgets::head_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>$this->ModelsApp->getJudulAgendaByslug($this->input->uri->getSegment('2')), 'agenda' => $this->ModelsApp->getAgendaByslug(urldecode($this->input->uri->getSegment('2')))->getResult()]);
		view_cell('App\Libraries\Widgets::navbar_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Agenda"]);

		$data = array(
			'agenda' => $this->ModelsApp->getAgendaByslug(urldecode($this->input->uri->getSegment('2')))->getResult(),
			'map' => $this->ModelsApp->getJudulAgendaByslug($this->input->uri->getSegment('2')), 
			'agendapopuler' => $this->ModelsApp->getAgendaLimit(5)->getResult(),
			'kategori' => $this->ModelsAdmin->getKategoriAgenda()->getResult(),

		);

		return view('landingpage/bacaagenda', $data);

	}

	//--------------------------------------------------------------

	public function industri(){

		view_cell('App\Libraries\Widgets::head_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>"Industri"]);
		view_cell('App\Libraries\Widgets::navbar_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Industri"]);

		if(isset($_GET['cari'])):

			$data = array(
				'map' => urldecode($_GET['cari']),
				'industripopuler' => $this->ModelsApp->getIndustriPopuler(6)->getResult(),
				'industri' => $this->ModelsApp->FilterIndustri($_GET['cari'])->getResult(),
				'pager' => null
			);

		else:

			$data = array(
				'map' => null,
				'industripopuler' => $this->ModelsApp->getIndustriPopuler(6)->getResult(),
				'industri' => $this->ModelsIndustri->paginate(8, 'industri'),
				'pager' => $this->ModelsIndustri->pager
			);

		endif;

		return view('landingpage/industri', $data);

	}

	public function detailindustri(){

		view_cell('App\Libraries\Widgets::head_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>"Industri"]);
		view_cell('App\Libraries\Widgets::navbar_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Industri"]);

		$data = array(
			'map' => $this->ModelsApp->getNamaIndustriBySlug($this->input->uri->getSegment('2')),
			'industri' => $this->ModelsApp->getIndustriBySlug($this->input->uri->getSegment('2'))->getResult(),
			'industripopuler' => $this->ModelsApp->getIndustriPopuler(6)->getResult(),
			'slug' => $this->input->uri->getSegment('2')
		);

		return view('landingpage/bacaindustri', $data);

	}

	public function getDataTablePendaftar(){
		$builder = $this->ModelsApp->getSiswaTerdaftarIndustriByIdindustri($this->ModelsApp->getIdIndustriByslug($this->input->getPost('slug')));
		return DataTable::of($builder)->addNumbering()->toJson();
	}

	//--------------------------------------------------------------

	public function monitoring(){
		view_cell('App\Libraries\Widgets::head_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>"Monitoring"]);
		view_cell('App\Libraries\Widgets::navbar_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Monitoring"]);

		$data = array(
			'absensi' => $this->ModelsApp->getTopSiswaAbsensiTerbaik(10)->getResult(),
			'jurnal' => $this->ModelsApp->getTopSiswaJurnalTerbaik(10)->getResult(),
			'industri' => $this->ModelsIndustri->paginate(8, 'industri'),
			'pager' => $this->ModelsIndustri->pager
		);

		return view('landingpage/monitoring', $data);

	}

	//--------------------------------------------------------------

	public function login(){
		view_cell('App\Libraries\Widgets::head_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>"Login"]);
		view_cell('App\Libraries\Widgets::navbar_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Login"]);
		view_cell('App\Libraries\Widgets::footer_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'location'=>"Login"]);

		return view('landingpage/login');

	}

}
