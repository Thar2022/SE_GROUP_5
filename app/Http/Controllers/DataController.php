<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Employee;

class DataController extends Controller
{
	public function getUserInfo(Request $request)
	{
		$userData = DB::table('users as u')
			->leftJoin('employee as e', 'u.email', '=', 'e.email')
			->leftJoin(DB::raw('(select id, name from role) as r'), 'u.role', '=', 'r.id')
			->where('u.id', $request->id)
			->select('u.id', 'u.email', 'u.role', 'e.fname', 'e.lname', 'e.phone', 'r.name as role_name')
			->first();

			if ($userData) {
				$userId = $userData->id;
				$email = $userData->email;
				$role = $userData->role;
				$fname = $userData->fname;
				$lname = $userData->lname;
				$phone = $userData->phone;
				$roleName = $userData->role_name;
			} else {
				return response()->json(['error' => 'User not found'], 404);
			}

			//show data
			return
			[
				'id' => $userId,
				'email' => $email,
				'role' => $role,
				'fname' => $fname,
				'lname' => $lname,
				'phone' => $phone,
				'role_name' => $roleName
			];
	}

	public function editPage(){
		$userData = DB::table('users as u')
			->leftJoin('employee as e', 'u.email', '=', 'e.email')
			->leftJoin(DB::raw('(select id, name from role) as r'), 'u.role', '=', 'r.id')
			->select('u.id', 'u.email', 'u.role', 'e.fname', 'e.lname', 'e.phone', 'r.name as role_name')
			->get();

			if ($userData) {
				return view('edituser', ['userData' => $userData]);
			} else {
				return response()->json(['error' => 'User not found'], 404);
			}
	}

	public function deleteUser(Request $request){
		try{
			$user = User::find($request->id);
			$user->delete();

			$employee = Employee::where('email', $user->email);
			$employee->delete();

			return back()->with('success', 'ลบผู้ใช้สำเร็จ');
		} catch (\Exception $e) {
			return response()->json(['error' => 'User not found'], 404);
		}

	}

	public function editUser(Request $request){
		$userData = DB::table('users as u')
			->leftJoin('employee as e', 'u.email', '=', 'e.email')
			->leftJoin(DB::raw('(select id, name from role) as r'), 'u.role', '=', 'r.id')
			->where('u.id', $request->id)
			->select('u.id', 'u.email', 'u.role', 'e.fname', 'e.lname', 'e.phone', 'r.name as role_name')
			->first();

			if ($userData) {
				$userId = $userData->id;
				$email = $userData->email;
				$role = $userData->role;
				$fname = $userData->fname;
				$lname = $userData->lname;
				$phone = $userData->phone;
				$roleName = $userData->role_name;
				return view('editselecteduser', ['userData' => $userData]);
			} else {
				return response()->json(['error' => 'User not found'], 404);
			}
	}

	public function saveEditedUser(Request $request){
		$userId = $request->id;
		$email = $request->email;
		$role = $request->role;
		$fname = $request->fname;
		$lname = $request->lname;
		$phone = $request->phone;

		//update user
		$user = User::find($userId);
		$user->email = $email;
		$user->role = $role;
		$user->save();

		//update employee
		$employee = Employee::where('email', $email)->first();
		//if employee not found
		if (!$employee) {
			$employee = new Employee;
			$employee->email = $email;
			$employee->username = $fname . ' ' . $lname;
		}
		$employee->fname = $fname;
		$employee->lname = $lname;
		$employee->phone = $phone;
		$employee->save();

		return back()->with('success', 'แก้ไขผู้ใช้สำเร็จ');
	}


}


