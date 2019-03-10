<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	function alert_red($string, $out = null)
	{
		if($out && $string != '')
		{
			$alert = '<div id="msgflutuante" class="alert alert-danger ks-solid" role="alert">'. $string . '</div>';

			return $alert;
		}
		else
		{
			if($string != '')
			{
				$alert = '<div class="alert alert-danger ks-solid" role="alert">'. $string . '</div>';
				
				return $alert;
			}
			else
			{
				return null;
			}
		}
	}

	function alert_success($string, $out = null)
	{
		if($out && $string != '')
		{
			$alert = '<div id="msgflutuante" class="alert alert-success ks-solid" role="alert">'. $string . '</div>';

			return $alert;
		}
		else
		{
			if($string != '')
			{
				$alert = '<div class="alert alert-success ks-solid" role="alert">'. $string . '</div>';

				return $alert;
			}
			else
			{
				return null;
			}
		}
	}
	
	function body_open($titulo = null)
	{
	echo '<main id="main">
			<div class="ks-page-container">
			    <div class="ks-column ks-page">
			        <div class="ks-content">
			            <div class="ks-body">
			                <div class="ks-nav-body-wrapper">
			                	<div class="container-fluid ks-rows-section">
			                    	<div class="row justify-content-center">';
	}
	function body_close()
	{
		echo '						</div>
								</div>	
							</div>
						</div>
					</div>
			     </div>
			</div>
		</main>';
	}