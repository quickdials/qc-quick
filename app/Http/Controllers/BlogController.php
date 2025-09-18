<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Blogdetails;
use Image;
use Auth;

class BlogController extends Controller
{
	/**
	 * Create a new controller instance.
	 *	
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{


		return view('admin.blog.index');
	}

	/**
	 * add services
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function add(Request $request)
	{

		$data['button'] = "Save";
		if ($request->isMethod('post') && $request->input('submit') == "Save") {

			$this->validate($request, [
				'name' => 'required|unique:blogdetails,name|max:200',
				'description' => 'required',
				'image' => 'required',
				'meta_title' => 'required',
				'meta_keywords' => 'required',
				'meta_description' => 'required',

			]);


			$blogdetails = new Blogdetails;
			$blogdetails->name = $request->input('name');
			$blogdetails->slug = generate_slug($request->input('meta_title'));
			$blogdetails->description = $request->input('description');
			$blogdetails->meta_title = $request->input('meta_title');
			$blogdetails->meta_keywords = $request->input('meta_keywords');
			$blogdetails->meta_description = $request->input('meta_description');
			$blogdetails->top_content = $request->input('top_content');
			$blogdetails->bottom_content = $request->input('bottom_content');

			//$file = $request->file('logo');
			// LOGO Pictures
			// *************
			if ($request->hasFile('image')) {
				$image = [];
				$filePath = getFolderBlogStructure();
				$file = $request->file('image');
				$filename = $file->getClientOriginalName();
				$destinationPath = public_path($filePath);
				$nameArr = explode('.', $filename);
				$ext = array_pop($nameArr);
				$name = implode('_', $nameArr);
				if (file_exists($destinationPath . '/' . $filename)) {
					$filename = $name . "_" . time() . '.' . $ext;
				}
				//$file->move($destinationPath, $filename);

					$imagePath = $file->getPathname();
					$targetWidth = 800;
					$targetHeight = 600;
					$quality = 75;

					$ext = strtolower($file->getClientOriginalExtension());

					 
					if ($ext === 'jpeg' || $ext === 'jpg') {
						$srcImage = imagecreatefromjpeg($imagePath);
					} elseif ($ext === 'png') {
						$srcImage = imagecreatefrompng($imagePath);
					} elseif ($ext === 'svg') {
						$file->move($destinationPath, $filename);
					}

					if ($ext === 'jpeg' || $ext === 'jpg' || $ext === 'png') {

						// Get original size
						list($width, $height) = getimagesize($imagePath);

						// Create new blank image
						$newImage = imagecreatetruecolor($targetWidth, $targetHeight);

						// Resize image
						imagecopyresampled(
							$newImage,
							$srcImage,
							0,
							0,
							0,
							0,
							$targetWidth,
							$targetHeight,
							$width,
							$height
						);

						// Save compressed image
						$outputPath = public_path($filePath . "/" . $filename);

						imagejpeg($newImage, $outputPath, $quality);  // For PNG, use imagepng()

						// Cleanup
						imagedestroy($srcImage);
						imagedestroy($newImage);

					}
					$image['large'] = array(
						'name' => $filename,
						'alt' => $filename,
						'width' => '',
						'height' => '',
						'src' => $filePath . "/" . $filename
					);

					if (!empty($blogdetails->image)) {
						$oldLogoImages = unserialize($blogdetails->image);
					}
					$blogdetails->image = serialize($image);

				 
			}
			// *************
			if ($request->hasFile('image_banner')) {
				$image = [];
				$filePath = getFolderBlogStructure();
				$file = $request->file('image_banner');
				$filename = $file->getClientOriginalName();
				$destinationPath = public_path($filePath);
				$nameArr = explode('.', $filename);
				$ext = array_pop($nameArr);
				$name = implode('_', $nameArr);
				if (file_exists($destinationPath . '/' . $filename)) {
					$filename = $name . "_" . time() . '.' . $ext;
				}
				//$file->move($destinationPath, $filename);

					$imagePath = $file->getPathname();
					$targetWidth = 800;
					$targetHeight = 600;
					$quality = 75;

					$ext = strtolower($file->getClientOriginalExtension());

					 
					if ($ext === 'jpeg' || $ext === 'jpg') {
						$srcImage = imagecreatefromjpeg($imagePath);
					} elseif ($ext === 'png') {
						$srcImage = imagecreatefrompng($imagePath);
					} elseif ($ext === 'svg') {
						$file->move($destinationPath, $filename);
					}

					if ($ext === 'jpeg' || $ext === 'jpg' || $ext === 'png') {

						// Get original size
						list($width, $height) = getimagesize($imagePath);

						// Create new blank image
						$newImage = imagecreatetruecolor($targetWidth, $targetHeight);

						// Resize image
						imagecopyresampled(
							$newImage,
							$srcImage,
							0,
							0,
							0,
							0,
							$targetWidth,
							$targetHeight,
							$width,
							$height
						);

						// Save compressed image
						$outputPath = public_path($filePath . "/" . $filename);

						imagejpeg($newImage, $outputPath, $quality);  // For PNG, use imagepng()

						// Cleanup
						imagedestroy($srcImage);
						imagedestroy($newImage);

					}
					$image['large'] = array(
						'name' => $filename,
						'alt' => $filename,
						'width' => '',
						'height' => '',
						'src' => $filePath . "/" . $filename
					);

					if (!empty($blogdetails->image_banner)) {
						$oldLogoImages = unserialize($blogdetails->image_banner);
					}
					$blogdetails->image_banner = serialize($image);

				 
			}



			if ($blogdetails->save()) {
				return redirect('/developer/blog/blogdetails')->with('success', 'Blog Details successfully added!');
			} else {
				return redirect('/developer/blog/blogdetails')->with('failed', 'Blog Details not added!');

			}


		}
		return view('admin.blog.index', $data);
	}


	/**
	 * Edit services
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, $id)
	{

		//echo "<pre>";print_r($_POST);die;
		$data['edit_data'] = Blogdetails::find($id);
		$data['button'] = "Update";	 
		if ($request->isMethod('post') && $request->input('submit') == "Update") {


			$this->validate($request, [
				'name' => 'required|max:200',
				'description' => 'required',
				'image' => 'required',
				'meta_title' => 'required',
				'meta_keywords' => 'required',
				'meta_description' => 'required',

			]);

			$blogdetails = Blogdetails::find($id);
			$blogdetails->name = $request->input('name');
			$blogdetails->slug = generate_slug($request->input('meta_title'));
			$blogdetails->description = $request->input('description');
			$blogdetails->meta_title = $request->input('meta_title');
			$blogdetails->meta_keywords = $request->input('meta_keywords');
			$blogdetails->meta_description = $request->input('meta_description');
			$blogdetails->top_content = $request->input('top_content');
			$blogdetails->bottom_content = $request->input('bottom_content');
			//$file = $request->file('logo');
			// LOGO Pictures
			// *************
			if ($request->hasFile('image')) {
				$image = [];
				$filePath = getFolderBlogStructure();
				 
				$file = $request->file('image');
				$filename = $file->getClientOriginalName();
				$destinationPath = public_path($filePath);
				$nameArr = explode('.', $filename);
				$ext = array_pop($nameArr);
				$name = implode('_', $nameArr);
				if (file_exists($destinationPath . '/' . $filename)) {
					$filename = $name . "_" . time() . '.' . $ext;
				}
				//$file->move($destinationPath, $filename);
				 $imagePath = $file->getPathname();
					$targetWidth = 800;
					$targetHeight = 600;
					$quality = 75;

					$ext = strtolower($file->getClientOriginalExtension());

					 
					if ($ext === 'jpeg' || $ext === 'jpg') {
						$srcImage = imagecreatefromjpeg($imagePath);
					} elseif ($ext === 'png') {
						$srcImage = imagecreatefrompng($imagePath);
					} elseif ($ext === 'svg') {
						$file->move($destinationPath, $filename);
					}

					if ($ext === 'jpeg' || $ext === 'jpg' || $ext === 'png') {

						// Get original size
						list($width, $height) = getimagesize($imagePath);

						// Create new blank image
						$newImage = imagecreatetruecolor($targetWidth, $targetHeight);

						// Resize image
						imagecopyresampled(
							$newImage,
							$srcImage,
							0,
							0,
							0,
							0,
							$targetWidth,
							$targetHeight,
							$width,
							$height
						);

						// Save compressed image
						$outputPath = public_path($filePath . "/" . $filename);

						imagejpeg($newImage, $outputPath, $quality);  // For PNG, use imagepng()

						// Cleanup
						imagedestroy($srcImage);
						imagedestroy($newImage);

					}
					$image['large'] = array(
						'name' => $filename,
						'alt' => $filename,
						'width' => '',
						'height' => '',
						'src' => $filePath . "/" . $filename
					);

					if (!empty($blogdetails->image)) {
						$oldLogoImages = unserialize($blogdetails->image);
					}
					$blogdetails->image = serialize($image);				 
			}
			if ($request->hasFile('image_banner')) {
				$image = [];
				$filePath = getFolderBlogStructure();
				 
				$file = $request->file('image_banner');
				$filename = $file->getClientOriginalName();
				$destinationPath = public_path($filePath);
				$nameArr = explode('.', $filename);
				$ext = array_pop($nameArr);
				$name = implode('_', $nameArr);
				if (file_exists($destinationPath . '/' . $filename)) {
					$filename = $name . "_" . time() . '.' . $ext;
				}
				//$file->move($destinationPath, $filename);
				 $imagePath = $file->getPathname();
					$targetWidth = 800;
					$targetHeight = 600;
					$quality = 75;

					$ext = strtolower($file->getClientOriginalExtension());

					 
					if ($ext === 'jpeg' || $ext === 'jpg') {
						$srcImage = imagecreatefromjpeg($imagePath);
					} elseif ($ext === 'png') {
						$srcImage = imagecreatefrompng($imagePath);
					} elseif ($ext === 'svg') {
						$file->move($destinationPath, $filename);
					}

					if ($ext === 'jpeg' || $ext === 'jpg' || $ext === 'png') {

						// Get original size
						list($width, $height) = getimagesize($imagePath);

						// Create new blank image
						$newImage = imagecreatetruecolor($targetWidth, $targetHeight);

						// Resize image
						imagecopyresampled(
							$newImage,
							$srcImage,
							0,
							0,
							0,
							0,
							$targetWidth,
							$targetHeight,
							$width,
							$height
						);

						// Save compressed image
						$outputPath = public_path($filePath . "/" . $filename);

						imagejpeg($newImage, $outputPath, $quality);  // For PNG, use imagepng()

						// Cleanup
						imagedestroy($srcImage);
						imagedestroy($newImage);

					}
					$image['large'] = array(
						'name' => $filename,
						'alt' => $filename,
						'width' => '',
						'height' => '',
						'src' => $filePath . "/" . $filename
					);

					// if (!empty($blogdetails->image_banner)) {
					// 	$oldLogoImages = unserialize($blogdetails->image_banner);
					// }
					$blogdetails->image_banner = serialize($image);

				 
			}

		 	if ($blogdetails->save()) {

				if (isset($oldLogoImages)) {
					foreach ($oldLogoImages as $oldImage) {
						try {
							if (!unlink(public_path($oldImage['src'])))
								throw new Exception("Old logo image not deleted...");
						} catch (Exception $e) {
							echo $e->getMessage();
						}
					}
				}
				return redirect('/developer/blog/blogdetails')->with('success', 'Blog Details successfully Update!');
			} else {
				return redirect('/developer/blog/edit/' . $id)->with('failed', 'Blog details  not Update!');

			}
		}
		return view('admin.blog.index', $data);
	}



	/**
	 * Edit services
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getPaginationBlog(Request $request)
	{
		if ($request->ajax()) {

			$blogdetails = Blogdetails::orderBy('id', 'desc');
			if ($request->input('search.value') != '') {
				$blogdetails = $blogdetails->where(function ($query) use ($request) {
					$query->orWhere('name', 'LIKE', '%' . $request->input('search.value') . '%');

				});
			}
			$blogdetails = $blogdetails->paginate($request->input('length'));
			$recordCollection = [];
			$data = [];
			$recordCollection['draw'] = $request->input('draw');
			$recordCollection['recordsTotal'] = $blogdetails->total();
			$recordCollection['recordsFiltered'] = $blogdetails->total();
		 
			foreach ($blogdetails as $blog) {
				$image = '';
				$action = '';
				$status = '';
				$separator = ' ';

				if ($blog->image != '') {
					$image = unserialize($blog->image);
					//$image = $image['thumbnail']['src'];
					$image = $image['large']['src'];
				}
					if (Auth::user()->current_user_can('admin') || Auth::user()->current_user_can('edit_blog') ) {
					$action .= $separator . '<a href="/developer/blog/edit/' . $blog->id . '"><i class="fa fa-edit" aria-hidden="true"></i></a>  ';

					}
 

				if (Auth::user()->current_user_can('administrator') ) {
				$action .=   $separator . '   <a href="/developer/blog/delete/' . $blog->id . '"><i class="fa fa-trash" aria-hidden="true"></i></a>';

				}
				
				
				

				if ($blog->status == '1') {
					$status .= '<a href="/developer/blog/status/' . $blog->id . '/0" class="btn btn-info m-b-5">Active</a>';

				} else {
					$status .= '<a href="/developer/blog/status/' . $blog->id . '/1" class="btn btn-warning m-b-5">In-Active</a>';
				}

				$data[] = [
					$blog->name,
					$blog->meta_title,
					'<img src="' . url($image) . '" width="50px">',
					$status,
					$action,
				];
			}
			$recordCollection['data'] = $data;
			return response()->json($recordCollection);


		}
	}

	public function imageDeleted(Request $request, $id)
	{


		$delet_data = Blogdetails::find($id);

		if ($delet_data->image != '') {

			$image = unserialize($delet_data->image);
			//$thumbnail = $image['thumbnail']['src'];
			$large = $image['large']['src'];

			// if (file_exists($thumbnail)) {
			// 	unlink($thumbnail);
			// }
			if (file_exists($large)) {
				unlink($large);
			}

		}

		$edit_data = array('image' => "", );
		$del = Blogdetails::where('id', $id)->update($edit_data);
		return redirect('developer/blog/edit/' . $id)->with("success", "Blog image deleted successfully.");



	}

	public function delBlogBanner(Request $request, $id)
	{
		$delet_data = Blogdetails::find($id);
		if ($delet_data->image_banner != '') {

			$image = unserialize($delet_data->image_banner);
	 
			$large = $image['large']['src']; 
			if (file_exists($large)) {
				unlink($large);
			}

		}

		$edit_data = array('image_banner' => "", );
		$del = Blogdetails::where('id', $id)->update($edit_data);
		return redirect('developer/blog/edit/' . $id)->with("success", "Blog image deleted successfully.");



	}


	public function deleted(Request $request, $id)
	{

		$blogdetails = Blogdetails::findorFail($id);

		if ($blogdetails->image != '') {

			$image = unserialize($blogdetails->image);

			// if (!empty($image['thumbnail']['src'])) {
			// 	$thumbnail = $image['thumbnail']['src'];
			// 	if (file_exists($thumbnail)) {
			// 		unlink($thumbnail);
			// 	}
			// }

			if (!empty($image['large']['src'])) {
				$large = $image['large']['src'];
				if (file_exists($large)) {
					unlink($large);
				}
			}
		}
		if ($blogdetails->delete()) {
			return redirect('/developer/blog/blogdetails')->with('success', 'Blog successfully deleted!');
		} else {
			return redirect('/developer/blog/blogdetails')->with('failed', 'Blog not deleted!');
		}

	}



	public function status(Request $request, $id, $val)
	{
		$blogdetails = Blogdetails::find($id);
		$blogdetails->status = $val;
		if ($blogdetails->save()) {
			return redirect('developer/blog/blogdetails')->with("success", "Status updated successfully.");
		} else {
			return redirect('developer/blog/blogdetails')->with("failed", "Status updated successfully.");
		}

	}




}
