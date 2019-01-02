<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function addcategory(Request $r)
    {
      $cat = new \App\Category;
      $cat->name = $r->nama;
      $cat->save();

      return redirect()->back()->with('success-add','Category Added Successfully');
    }

    public function editcategory(Request $r)
    {
      $cat = \App\Category::where('id',$r->id)->first();
      $cat->name = $r->nama;
      $cat->save();

      return redirect()->back()->with('success-edit','Category Edited Successfully');
    }

    public function deletecategory($id)
    {
      \App\Category::where('id',$id)->delete();

      return redirect()->back()->with('success-delete','Category Deleted Successfully');
    }

    public function addslides(Request $r)
    {

      $image = $r->picture;
      $image->move(public_path().'/'.'slides/',(\App\Slides::max('id')+1).'.jpg');

      $slides = new \App\Slides;
      $slides->title = $r->title;
      $slides->picture = 'slides/'.(\App\Slides::max('id')+1).'.jpg';

      $slides->save();

      return redirect()->back()->with('success-add','Slides Added Successfully');
    }

    public function editslides(Request $r)
    {
      if(isset($r->picture))
      {
        $image = $r->picture;
        $image->move(public_path().'/'.'slides/',(\App\Slides::max('id')+1).'.jpg');

        $slides = \App\Slides::where('id',$r->id)->first();
        $slides->title = $r->title;
        $slides->picture = 'slides/'.(\App\Slides::max('id')+1).'.jpg';

        $slides->save();
      }
      else {
        $slides = \App\Slides::where('id',$r->id)->first();
        $slides->title = $r->title;

        $slides->save();
      }

      return redirect()->back()->with('success-edit','Slides Edited Successfully');
    }

    public function deleteslides($id)
    {
      \App\Slides::where('id',$id)->delete();
      return redirect()->back()->with('success-delete','Category Deleted Successfully');
    }

    public function addusers(Request $r)
    {
      $users = new \App\User;
      $users->email = $r->username;
      $users->password = bcrypt($r->password);
      $users->full_name = $r->fullname;
      $users->address = $r->address;
      $users->phone = $r->phone;
      $users->id_role = $r->role;

      $users->save();

      return redirect()->back()->with('success-add','Users Added Successfully');
    }

    public function editusers(Request $r)
    {
      if(isset($r->password))
      {
        $users = \App\User::where('id',$r->id)->first();
        $users->email = $r->username;
        $users->password = bcrypt($r->password);
        $users->full_name = $r->fullname;
        $users->address = $r->address;
        $users->phone = $r->phone;
        $users->id_role = $r->role;

        $users->save();
      }
      else {
        $users = \App\User::where('id',$r->id)->first();
        $users->email = $r->username;
        $users->full_name = $r->fullname;
        $users->address = $r->address;
        $users->phone = $r->phone;
        $users->id_role = $r->role;

        $users->save();
      }

      return redirect()->back()->with('success-edit','Users Edited Successfully');
    }

    public function deleteusers($id)
    {
      \App\User::where('id',$id)->delete();

      return redirect()->back()->with('success-delete','Users Deleted Successfully');
    }
}
