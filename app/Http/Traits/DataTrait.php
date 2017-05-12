<?php

namespace App\Http\Traits;

trait DataTrait {

	/**
	 *
	 * Array String yang tidak bisa masuk ke fungsi pencarian
	 *
	 */

	private $blacklist = ['search', 'sort', 'sortType', 'take', 'skip', 'paginate', 'page', 'role'];

	// Variable Untuk Mengatur Jumlah Data yang Dimunculkan dalam Paginasi
	private $paginate_number = 5;

	// Array untuk appends request
	private $join = [];

	/**
	 *
	 * $request : Object Class Request
	 * $search : Closure untuk pencarian pada suatu field
	 * $another : Closure Custom Query
	 *
	 */

	public function showData($request, $search = null, $another = null) {
		$table = $this->table;
		$blacklist = $this->blacklist;
		// Ambil Seluruh Request
		$inputs = $request->all();

		/**
		 *
		 * Pencarian berdasarkan data yang di request
		 *
		 * Penggunaan :
		 *
		 * http://contoh.com/index?status=success
		 * Menampilkan data dari kolom status dengan nilai 'success'
		 *
		 * http://conton.com/index?status=success&id=1
		 * Menampilkan data dari kolom status dengan nilai 'success' DAN id 1
		 */

		$table = $table->where(function ($q) use ($inputs, $blacklist) {
			foreach ($inputs as $input => $inputVal) {
				if (!in_array($input, $blacklist)) {
					$q->where($input, $inputVal);
					$this->join[$input] = $inputVal;
				}
			}
		});

		/**
		 *
		 * Method Search
		 *
		 * Penggunaan:
		 *
		 * http://contoh.com/index?search=kata_kunci
		 */

		if (isset($request->search)) {
			$table = $table->where(function ($q) use ($search) {
				call_user_func($search, $q);
			});
		}

		/**
		 *
		 * Method Sorting
		 *
		 * Penggunaan :
		 *
		 * http://contoh.com/index?sort=nama_kolom&sortType=[ASC/DESC]
		 *
		 * Default sorting berdasarkan kolom created_at dengan tipe Descending
		 */

		if (isset($request->sort) && isset($request->sortType)) {
			if (str_contains($request->sort, '.')) {
				$split = explode('.', $request->sort);
				$table = $table->modelJoin($request->sort);
				$table = $table->orderBy($split[0] . "_" . $split[1], $request->sortType);
			} else {
				$table = $table->orderBy($request->sort, $request->sortType);
				$this->join['sort'] = $request->sort;
				$this->join['sortType'] = $request->sortType;
			}
		} else {
			$table = $table->orderBy('created_at', 'DESC');
		}

		/**
		 *
		 * Method Untuk Custom Query
		 *
		 */

		if (isset($another)) {
			call_user_func($another, $table);
		}

		/**
		 *
		 * Method Take
		 *
		 * Penggunaan :
		 *
		 * http://contoh.com/index?take=1
		 */

		if (isset($request->take) || $request->take != '') {
			$table = $table->take($request->take);
		}

		/**
		 *
		 * Method Skip
		 *
		 * Penggunaan :
		 *
		 * http://contoh.com/index?skip=[number]
		 */

		if (isset($request->skip) || $request->skip != '') {
			$table = $table->skip($request->skip);
		}

		/**
		 *
		 * Pengkondisian Apakah Data di Paginasi atau Tidak
		 *
		 */

		if (isset($request->paginate) && $request->paginate == '0') {
			$table = $table->get();
		} else if (isset($request->take) && $request->take == '1') {
			$table = $table->first();
		} else {
			$table = $table->paginate($this->paginate_number)
				->appends($this->join);
		}

		return $table;
	}

}