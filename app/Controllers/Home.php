<?php

namespace App\Controllers;

use App\Models\Application;
use App\Models\ModelsAdmin;
use App\Models\Agenda;
use App\Models\Industri;

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

		view_cell('App\Libraries\Widgets::head_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>$this->ModelsApp->getJudulAgendaByslug($this->input->uri->getSegment('1')), 'agenda' => $this->ModelsApp->getAgendaByslug(urldecode($this->input->uri->getSegment('1')))->getResult()]);
		view_cell('App\Libraries\Widgets::navbar_home', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Agenda"]);

		$data = array(
			'agenda' => $this->ModelsApp->getAgendaByslug(urldecode($this->input->uri->getSegment('1')))->getResult(),
			'map' => $this->ModelsApp->getJudulAgendaByslug($this->input->uri->getSegment('1')), 
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

}
