<?php
	class TicketController extends Controller {
		function index()
		{
			if(!Auth::user())
				die("Du �r utloggad. Ledsen.");
		}
	}
?>