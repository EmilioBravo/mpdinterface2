<?php

class main extends controller {
	public function start() {
		$f3 = $this->framework;
		$mpd = $this->mpd;
		
		$f3->set('state', $mpd->getState());
		$f3->set('playlist', $mpd->getPlaylist());
		$f3->set('currentTrack', $mpd->getCurrentTrackInfo());
		$f3->set('streamType', $mpd->getStreamType($f3->get('mpd_httpd_host'), $f3->get('mpd_httpd_port')));

		$this->tpserve();
	}
	
	public function control() {
		$f3 = $this->framework;
		$mpd = $this->mpd;
		
		$option = $f3->get('PARAMS.option');	
		
		switch($option) {
			case 'pause':
				$mpd->controlPause();
				break;
			case 'play':
				$mpd->controlPlay();
				break;
			case 'stop':
				$mpd->controlStop();
				break;
			case 'next':
				$mpd->controlNext();
				break;
			case 'previous':
				$mpd->controlPrevious();
				break;
		}
	}
	
	public function status() {
		$f3 = $this->framework;
		$mpd = $this->mpd;
		
		echo json_encode(array(
			"state" => $f3->set('state', $mpd->getState()),
			"currentTrack" => $f3->set('currentTrack', $mpd->getCurrentTrackInfo())
		));
	}
}