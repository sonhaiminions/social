<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller {
	public function getresult(Request $request) {
		if ($request->input('query') == null) {
			$null = "u dont enter the key!";
			return view('search', ['result2' => $null]);
		}
		$query = '%' . $request->input('query') . '%';
		$result = User::where('username', 'like', $query)
			->orWhere('firstname', 'like', $query)->orWhere('lastname', 'like', $query)
//			->take(3)
			->get();

		return view('search', ['result' => $result, 'key' => $request->input('query')]);
	}

}

?>
