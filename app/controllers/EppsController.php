<?php

class EppsController extends \BaseController {

	/**
	 * Display a listing of epps
	 *
	 * @return Response
	 */
	public function index()
	{
		$epps = Epp::all();

		return View::make('epps.index', compact('epps'));
	}

	/**
	 * Show the form for creating a new epp
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('epps.create');
	}

	/**
	 * Store a newly created epp in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Epp::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Epp::create($data);

		return Redirect::route('epps.index');
	}

	/**
	 * Display the specified epp.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$epp = Epp::findOrFail($id);

		return View::make('epps.show', compact('epp'));
	}

	/**
	 * Show the form for editing the specified epp.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$epp = Epp::find($id);

		return View::make('epps.edit', compact('epp'));
	}

	/**
	 * Update the specified epp in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$epp = Epp::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Epp::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$epp->update($data);

		return Redirect::route('epps.index');
	}

	/**
	 * Remove the specified epp from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Epp::destroy($id);

		return Redirect::route('epps.index');
	}

}
