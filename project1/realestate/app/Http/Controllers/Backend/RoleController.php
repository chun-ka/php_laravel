<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function AllPermission()
    {
        $permission = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permission'));
    }

    public function AddPermission()
    {
        return view('backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request)
    {
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id){
        $permission=Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission',compact('permission'));
    }

    public function UpdatePermission(Request $request)
    {
        $per_id=$request->id;
        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id){
        Permission::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ImportPermission(){
        return view('backend.pages.permission.import_permission');
    }

    public function Export(){
        //gọi đến lớp PermissionExport và thực hiện phương thức collection();
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }

    public function Import(Request $request){
        Excel::import(new PermissionImport, $request->file('import_file'));
        $notification = array(
            'message' => 'Permission Import Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    // ==== Roles All Method ======//
    public function AllRoles(){
        $roles = Role::all();
        return view('backend.pages.roles.all_roles', compact('roles'));
    }

    public function AddRoles()
    {
        return view('backend.pages.roles.add_roles');
    }

    public function StoreRoles(Request $request)
    {
        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Roles create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    }

    public function EditRoles($id){
        $roles=Role::findOrFail($id);
        return view('backend.pages.roles.edit_roles',compact('roles'));
    }

    public function UpdateRoles(Request $request)
    {
        $r_id=$request->id;
        Role::findOrFail($r_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Roles Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    }

    public function DeleteRoles($id){
        Role::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Roles Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    // ==== Roles Permission All Method ======//
    public function AddRolesPermission(){
        $roles = Role::all();
        $permission_groups=User::getPermissionGroup();
        //Có thể ghi như thế này được sao lại làm phức tap thế -->Không hiểu
//      $permission_groups=Permission::select('group_name')->groupBy('group_name')->get();
        return view('backend.pages.rolesetup.add_roles_permission',compact('roles','permission_groups'));
    }

    public function RolePermissionStore(Request $request){
//        $data=array();
        $permissions=$request->permission;

        foreach ($permissions as $key=>$item){
//            $data['role_id']=$request->role_id;
//            $data['permission_id']=$item;

            DB::table('role_has_permissions')->insert([
                'role_id'=>$request->role_id,
                'permission_id'=>$item
            ]);
        }
        $notification = array(
            'message' => 'Roles Permission Add Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function AllRolesPermission(){

        //Lấy dữ liệu chung của hai bảng roles và permissions có thêm bảng phụ(mối quan hệ n-n)
        $roles=Role::all();  //Vì không có model nên phải sử dụng all()
        return view('backend.pages.rolesetup.all_roles_permission',compact('roles'));
    }

    public function AdminEditRoles($id){
        $role=Role::findOrFail($id);
        $permission = Permission::all();
        $permission_groups=User::getPermissionGroup();
        return view('backend.pages.rolesetup.edit_roles_permission',compact('permission','role','permission_groups'));
    }

    public function AdminRolesUpdate(Request $request,$id){
        $role=Role::findOrFail($id);
        $permissions=$request->permission;

        if (!empty($permissions)){

            $role->syncPermissions($permissions);      //phương thức hỗ trợ để đồng bộ role và permissions/update lại dữ liệu luôn
        }

        $notification = array(
            'message' => 'Roles Permission Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function AdminDeleteRoles($id){
        $role=Role::findOrFail($id);
        if (!is_null($role)){
            $role->delete();
        }
        $notification = array(
            'message' => 'Roles Permission Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
