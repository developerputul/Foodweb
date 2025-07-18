<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Gllery;
use App\Models\Menu;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function AllMenu()
    {
        $menu = Menu::latest()->get();
        return view('client.backend.menu.all_menu', compact('menu'));
    } //End Method

    public function AddMenu()
    {
        return view('client.backend.menu.add_menu');
    } //End Method

    public function StoreMenu(Request $request)
    {

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' .
                $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/menu/' . $name_gen));
            $save_url = 'upload/menu/' . $name_gen;

            Menu::create([
                'menu_name' => $request->menu_name,
                'image' =>  $save_url,
            ]);
        }
        $notification = array(
            'message' => 'Menu Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.menu')->with($notification);
    } //End Method

    public function EditMenu($id)
    {
        $menu = Menu::find($id);
        return view('client.backend.menu.edit_menu', compact('menu'));
    } //End Method

    public function UpdateMenu(Request $request)
    {

        $menu_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' .
                $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/menu/' . $name_gen));
            $save_url = 'upload/menu/' . $name_gen;

            Menu::find($menu_id)->update([
                'menu_name' => $request->menu_name,
                'image' =>  $save_url,
            ]);

            $notification = array(
                'message' => 'Menu Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.menu')->with($notification);
        } else {

            Menu::find($menu_id)->update([
                'menu_name' => $request->menu_name,
            ]);

            $notification = array(
                'message' => 'Menu Updated Without Image',
                'alert-type' => 'success'
            );
            return redirect()->route('all.menu')->with($notification);
        }
    } //End Method

    public function DeleteMenu($id)
    {
        $item = Menu::find($id);
        $img = $item->image;
        unlink($img);

        Menu::find($id)->delete();

        $notification = array(
            'message' => 'Menu Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //End Method

    ///Product all Method

    public function AllProduct()
    {

        $product = Product::latest()->get();
        return view('client.backend.product.all_product', compact('product'));
    } //End Method

    public function AddProduct()
    {
        $category = Category::latest()->get();
        $menu = Menu::latest()->get();
        $city = City::latest()->get();
        return view('client.backend.product.add_product', compact('category', 'menu', 'city'));
    } //End Method

    public function StoreProduct(Request $request)
    {
        $pcode = IdGenerator::generate(['table' => 'products', 'field' => 'code', 'length' => 5, 'prefix' => 'PC']);

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' .
                $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/product/' . $name_gen));
            $save_url = 'upload/product/' . $name_gen;

            Product::create([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name,)),
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'menu_id' => $request->menu_id,
                'code' => $pcode,
                'qty' => $request->qty,
                'size' => $request->size,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'client_id' => Auth::guard('client')->id(),
                'most_popular' => $request->most_popular,
                'best_seller' => $request->best_seller,
                'created_at' => Carbon::now(),
                'status'  => 1,
                'image' =>  $save_url,
            ]);
        }
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.product')->with($notification);
    } //End Method

    public function EditProduct($id)
    {
        $category = Category::latest()->get();
        $menu = Menu::latest()->get();
        $city = City::latest()->get();
        $product = Product::find($id);
        return view('client.backend.product.edit_product', compact('category', 'menu', 'city', 'product'));
    } //End Method

    public function ProductUpdate(Request $request)
    {

        $pro_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' .
                $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/product/' . $name_gen));
            $save_url = 'upload/product/' . $name_gen;

            Product::find($pro_id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name,)),
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'menu_id' => $request->menu_id,
                'qty' => $request->qty,
                'size' => $request->size,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'most_popular' => $request->most_popular,
                'best_seller' => $request->best_seller,
                'created_at' => Carbon::now(),
                'image' =>  $save_url,
            ]);
            $notification = array(
                'message' => 'Product Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.product')->with($notification);
        } else {

            Product::find($pro_id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name,)),
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'menu_id' => $request->menu_id,
                'qty' => $request->qty,
                'size' => $request->size,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'most_popular' => $request->most_popular,
                'best_seller' => $request->best_seller,
                'created_at' => Carbon::now(),

            ]);
            $notification = array(
                'message' => 'Product Updated Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.product')->with($notification);
        }
    } //End Method

    public function DeleteProduct($id)
    {

        $item = Product::find($id);
        $img = $item->image;
        unlink($img);

        Product::find($id)->delete();

        $notification = array(
            'message' => 'Product Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function ChangeStatus(Request $request)
    {

        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success' => 'Status Change Successfully']);
    }
    // End Method 

    /////////////All Gallery Method////////////

    public function AllGallery()
    {
        $gallery = Gllery::latest()->get();
        return view('client.backend.gallery.all_gallery', compact('gallery'));
    }
    //End Method

    public function AddGallery()
    {

        return view('client.backend.gallery.add_gallery');
    }
    //End Method

    public function StoreGallery(Request $request)
    {
        $images = $request->file('gallery_img');

        foreach ($images as $gimg) {

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' .
                $gimg->getClientOriginalExtension();
            $img = $manager->read($gimg);
            $img->resize(400, 400)->save(public_path('upload/gallery/' . $name_gen));
            $save_url = 'upload/gallery/' . $name_gen;

            Gllery::insert([
                'client_id' => Auth::guard('client')->id(),
                'gallery_img' => $save_url,
            ]);
        } //end foreach

        $notification = array(
            'message' => 'Gallery Image Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.gallery')->with($notification);
    }
    //End Method

    public function EditGallery($id)
    {
        $gallery = Gllery::find($id);
        return view('client.backend.gallery.edit_gallery', compact('gallery'));
    }
    //End Method

    public function GalleryUpdate(Request $request)
    {

        $gallery_id = $request->id;

        if ($request->hasFile('gallery_img')) {
            $image = $request->file('gallery_img');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(400, 400)->save(public_path('upload/gallery/' . $name_gen));
            $save_url = 'upload/gallery/' . $name_gen;

            $gallery = Gllery::find($gallery_id);
            if ($gallery->gallery_img) {
                $img = $gallery->gallery_img;
                unlink($img);
            }

            $gallery->update([
                'gallery_img' => $save_url,
            ]);
            $notification = array(
                'message' => 'Gallery Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.gallery')->with($notification);
        } else {
            $notification = array(
                'message' => 'No Image Selected for Update',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
    }
    //End Method

    public function DeleteGallery($id)
    {

        $item = Gllery::find($id);
        $img = $item->gallery_img;
        unlink($img);

        Gllery::find($id)->delete();

        $notification = array(
            'message' => 'Gallery Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //End Method
}
