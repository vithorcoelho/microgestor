<?php

use Dompdf\Dompdf;

class gerarpdf
{
	public $dompdf;

	public function __construct()
	{
		require_once '../dompdf/autoload.inc.php';

		$this->dompdf = new Dompdf;
	}

	public function BaixarPDF($file, $nome)
	{
		$this->dompdf->loadHtml($file);
		$this->dompdf->render();
		$this->dompdf->stream($nome);
	}
}