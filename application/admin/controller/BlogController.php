<?php 
namespace app\admin\controller;
use app\blog\model\Article;
use app\blog\model\Category;
use app\blog\model\Photos;
use think\Controller;
use think\View;
use think\Request;
use think\Db;
use think\Image;
class BlogController extends Controller 
{	
	public function articleList(){
		// 获取cate_id
		$cate_id = Request::instance()->param('id');
		// 实例化文章模型
		$article = new Article();
		// 有cate_id的值，就查询cate_id的文章
		if(!empty($cate_id)){
			// 查询所有文章
	        $allArticle = $article->where('cate_id',$cate_id)->order('art_id desc')->paginate(6);
		}
		else{
			// 查询所有文章
	        $allArticle = $article->order('art_id desc')->paginate(6);
		}
		// 实例化模型
		$category = new Category();
		// 查询数据集 标题，描述，封面，创建时间字段
		$category_data = $category->field('cate_id,cate_name')->select();

		
		// 实例化视图类	
		$view = new View();
		// 实例化common类
		$common = new Common();
		// 获取相册的总数
		$view->album_count = $common->alubmCount();
		// 获取照片总数
		$view->photos_count = $common->photosCount();
		// 获取留言总数
		$view->message_count = $common->messageCount();
		// 获取博客文章总数
		$view->article_count = $common->articleCount();
		// 获取博客分类总数
		$view->category_count = $common->categoryCount();
		// 渲染模板输出
		return $view->fetch('admin/blog/articleList',['category_data'=>$category_data,'allArticle'=>$allArticle]);
	}
	public function addArticle(){
		// 实例化模型
		$category = new Category();
		// 查询数据集 标题，描述，封面，创建时间字段
		$category_data = $category->field('cate_id,cate_name')->select();
		// 实例化视图类	
		$view = new View();
		// 实例化common类
		$common = new Common();
		// 获取相册的总数
		$view->album_count = $common->alubmCount();
		// 获取照片总数
		$view->photos_count = $common->photosCount();
		// 获取留言总数
		$view->message_count = $common->messageCount();
		// 获取博客文章总数
		$view->article_count = $common->articleCount();
		// 获取博客分类总数
		$view->category_count = $common->categoryCount();
		// 渲染模板输出
		return $view->fetch('admin/blog/addArticle',['category_data'=>$category_data]);
	}
	public function editArticle(){
		// 获取a_id
		$art_id = Request::instance()->param('id');
		// 获取数据
		$article = Article::get($art_id);
		// 实例化模型
		$category = new Category();
		// 查询数据集 标题，描述，封面，创建时间字段
		$category_data = $category->field('cate_id,cate_name')->select();
		// 实例化视图类	
		$view = new View();
		// 实例化common类
		$common = new Common();
		// 获取相册的总数
		$view->album_count = $common->alubmCount();
		// 获取照片总数
		$view->photos_count = $common->photosCount();
		// 获取留言总数
		$view->message_count = $common->messageCount();
		// 获取博客文章总数
		$view->article_count = $common->articleCount();
		// 获取博客分类总数
		$view->category_count = $common->categoryCount();
		// 渲染模板输出
		return $view->fetch('admin/blog/editArticle',['article'=>$article,"category_data"=>$category_data]);

	}
	public function addArticleController(Request $request){
		// 标识文章是否有图片，默认有
		$isPhotos = true;
		// 获取所有post内容
		$data = input('post.');
		// 把文章赋值给一个变量，用于删除图片标签去获取关键字和标签
		$content = $data['content'];
		// 获取内容中的图片地址，结果是一个二维数组,这里考虑到取出表情图片，如果有去除有http子串的img
		$imagesArr = getContentImages($data['content'],'http');
		// 删除html所有标签
		$content = strip_tags($content);
		// 判断数组是否为空，如果为空代表文章没有图片
		if(!count($imagesArr[1])){
			// 则给文章的封面图赋值一个默认的图片
			$cover =  DS . 'static' . DS . 'blog' . DS . 'images' . DS . 'defaultCover.jpg';
			// 给标识赋值false，表示文章没有图片
			$isPhotos = false;
		}else{
			// 如果文章有图片，则把文章内容中第一张图片赋值给封面图
			$cover = $imagesArr[1][0];
			
		}
		// 获取标签 结果是一个数组
		$tagsArr = get_tags_arr($content);
		// 定义一个空串
		$tags = '';
		// 循环该数组，加上逗号
		foreach ($tagsArr as $key => $value) {
			$tags .= $value.',';
		}
		// 删除最后一个逗号
		$tags = deleteStringLastChar($tags);
		// 获取关键字 结果是一个字符串
		$keywords = get_keywords_str($content);
		// 实例化表模型
		$article = new Article;
		// 新增数据
		$article->art_title  = $data['title'];
		$article->art_tag = $tags;
		$article->art_keywords = $keywords;
		$article->art_description = $data['desc'];
		$article->art_cover = $cover;
		$article->art_content = $data['content'];
		$article->art_time = date('Y-m-d H:i:s',time());
		$article->art_editor = $data['author'];
		$article->cate_id = $data['category'];
		$article->art_show = cutstr_html($content,150);
		// 保存数据
		$article->save();
		// 判断内容是否有图片
		if($isPhotos){
			// 循环图片用于保存数据
			foreach ($imagesArr[1] as $key => $value) {
				$list[] =  [ 'art_id'=>$article->art_id, 'pho_address'=> $value];
			}
			// 实例化表模型
			$photos = new Photos;
			// 新增图片数据 
			if($photosResult = $photos->saveAll($list)){
			// 返回成功标识
			return json(["message"=>"发布文章成功~","ico"=>1]);
			}
		}
		// 返回成功标识
		return json(["message"=>"发布文章成功~","ico"=>1]);


	}
	public function editArticleController(){
		// 获取art_id
		$art_id = Request::instance()->param('id');
		// 获取表模型
		$article = Article::get($art_id);
		// 实例化表模型
		$photos = new Photos();
		// 先删除该文章之前的图片数据(这里只删除数据库信息，不删除源图片)
		$photos->where('art_id',$art_id)->delete();
		// 标识文章是否有图片，默认有
		$isPhotos = true;
		// 获取所有post内容
		$data = input('post.');
		// 把文章赋值给一个变量，用于删除图片标签去获取关键字和标签
		$content = $data['content'];
		// 获取内容中的图片地址，结果是一个二维数组,这里考虑到取出表情图片，如果有去除有http子串的img
		$imagesArr = getContentImages($data['content'],'http');
		// 删除html标签
		$content = strip_tags($content);
		// 判断数组是否为空，如果为空代表文章没有图片
		if(!count($imagesArr[1])){
			// 则给文章的封面图赋值一个默认的图片
			$cover =  DS . 'static' . DS . 'blog' . DS . 'images' . DS . 'defaultCover.jpg';
			// 给标识赋值false，表示文章没有图片
			$isPhotos = false;
		}else{
			// 如果文章有图片，则把文章内容中第一张图片赋值给封面图
			$cover = $imagesArr[1][0];
		}
		// 获取标签 结果是一个数组
		$tagsArr = get_tags_arr($content);
		// 定义一个空串
		$tags = '';
		// 循环该数组，加上逗号
		foreach ($tagsArr as $key => $value) {
			$tags .= $value.',';
		}
		// 删除最后一个逗号
		$tags = deleteStringLastChar($tags);
		// 获取关键字 结果是一个字符串
		$keywords = get_keywords_str($content);
		// 更新数据
		$article->art_title  = $data['title'];
		$article->art_tag = $tags;
		$article->art_keywords = $keywords;
		$article->art_description = $data['desc'];
		$article->art_cover = $cover;
		$article->art_content = $data['content'];
		$article->art_time = date('Y-m-d H:i:s',time());
		$article->art_editor = $data['author'];
		$article->cate_id = $data['category'];
		$article->art_show = cutstr_html($content,150);
		// 保存数据
		$article->save();
		// 判断内容是否有图片
		if($isPhotos){
			// 循环图片用于保存数据
			foreach ($imagesArr[1] as $key => $value) {
				$list[] =  [ 'art_id'=>$art_id, 'pho_address'=> $value];
			}
			// 新增图片数据 
			if($photosResult = $photos->saveAll($list)){
			// 返回成功标识
			return json(["message"=>"更新文章成功~","ico"=>1]);
			}
		}
		// 返回成功标识
		return json(["message"=>"更新文章成功~","ico"=>1]);
	}
	public function deleteArticle(){
		// 获取post过来的数据
		$data = input('post.');
		// 把json数据转成对象
		$data = json_decode($data['ajaxData']);
		// 获取cate_id
		$art_id = $data->art_id;
		// 实例化分类模型
		$article = Article::get($art_id);
		// 获取图片数量
		$photos = Photos::where('art_id',$art_id)->count();
		// 如果不为0 代表有图片
		if($photos){
			// 实例化图片模型
			$articlePhotos = new Photos();
			// 查询所有文章图片数据
			$allPhotos = $articlePhotos->where('art_id',$art_id)->field('pho_address')->select();
			// 循环删除文章图片
			foreach ($allPhotos as  $value) {
				unlink(ROOT_PATH . 'public' . $value->pho_address);
			}
			// 删除该记录
			$articlePhotos->where('art_id',$art_id)->delete();
		}
		// 删除文章记录
		if($article->delete()){
			return json(["message"=>"删除文章成功！","ico"=>1]);
		}
		return json(["message"=>"删除文章失败！","ico"=>5]);
	}
	public function uploadArticlePhotos(Request $request){
		// 获取文件信息
		$files = $request->file('file');
		// 获取处理图片类
		$image = \think\Image::open($files);
		// 缩略图 thumb(最大宽度,最大高度,裁剪类型) 1代表等比例裁剪
		$image->thumb(2000, 2000, 1); 
		// 添加水印
		$image->text('By http://www.joker1996.com', 'Basileia.ttf', 20, '#ffffff');
		// 以当前时间命名水印
		$saveName = $request->time() . '.png';
		// 定义博客图片地址
		$blogImages = ROOT_PATH . 'public' . DS . 'static' . DS . 'blog' . DS . 'articleImages' . DS;
		// 判断是否存在当前日期的文件夹，不存在则创建
		if (!is_dir( $blogImages.date('Y-m-d',time()))){ 
			// 创建以当前日期命名的文件夹，并且给0777 可读可执行可修改权限
			mkdir($blogImages.date('Y-m-d',time()), 0777); // 使用最大权限0777创建文件
			chmod($blogImages.date('Y-m-d',time()),0777); // 使用最大权限0777创建文件
		}
		// 保存到指定路径
		$thumb = $image->save($blogImages.date('Y-m-d',time()). DS .$saveName);
		// 返回图片路径
		$path = DS . 'static' . DS . 'blog' . DS . 'articleImages' . DS . date('Y-m-d',time()).DS .$saveName;
		// 转义反斜线
		$path = addslashes($path);
		// 保存成功就返回图片地址
		if($thumb){
			/*
				返回图片的json格式为
				{
				  "code": 0 //0表示成功，其它失败
				  ,"msg": "" //提示信息 //一般上传失败后返回
				  ,"data": {
				    "src": "图片路径"
				    ,"title": "图片名称" //可选
				  }
				}
			*/
			return '{  "code": 0 ,"msg": "上传成功","data": {    "src": "' . $path. '","title": "'.$saveName.'"}}';
		}
		return '{  "code": 1 ,"msg": "上传失败"}';
	}
	// 返回添加分类视图
	public function addCategory(){
		// 实例化视图类	
		$view = new View();
		// 实例化common类
		$common = new Common();
		// 获取相册的总数
		$view->album_count = $common->alubmCount();
		// 获取照片总数
		$view->photos_count = $common->photosCount();
		// 获取留言总数
		$view->message_count = $common->messageCount();
		// 获取博客文章总数
		$view->article_count = $common->articleCount();
		// 获取博客分类总数
		$view->category_count = $common->categoryCount();
		// 渲染模板输出
		return $view->fetch('admin/blog/addCategory');
		// return redirect('http://www.joker1996.com/admin/index/uploadphotos.html');
	}
	public function categoryList(){
		// 实例化视图类	
		$view = new View();
		// 实例化common类
		$common = new Common();
		// 获取相册的总数
		$view->album_count = $common->alubmCount();
		// 获取照片总数
		$view->photos_count = $common->photosCount();
		// 获取留言总数
		$view->message_count = $common->messageCount();
		// 获取博客文章总数
		$view->article_count = $common->articleCount();
		// 获取博客分类总数
		$view->category_count = $common->categoryCount();
		// 实例化模型
		$category = new Category();
		// 查询数据集 标题，描述，封面，创建时间字段
		$category_data = $category->field('cate_id,cate_name,cate_tags,cate_description')->select();
		// 渲染模板输出
		return $view->fetch('admin/blog/categoryList',['category_data'=>$category_data]);
	}
	public function addCategoryController(){
		// 获取post过来的数据
		$data = input('post.');
		// 实例化模型
		$category = new Category;
		// 给模型的属性字段赋值
		$category->cate_name = $data['category_title'];
		$category->cate_description = $data['category_desc'];
		$category->cate_tags = $data['category_tag'];
		// 添加数据
		if($category->save()){
		// 返回json数据通知
		return json(["message"=>"添加分类成功！","ico"=>1]);
		}
		return json(["message"=>"添加分类失败！","ico"=>5]);
	}
	public function editCategory(){
		// 获取a_id
		$cate_id = Request::instance()->param('id');
		// 获取数据
		$category = Category::get($cate_id);
		// 实例化视图类	
		$view = new View();
		// 实例化common类
		$common = new Common();
		// 获取相册的总数
		$view->album_count = $common->alubmCount();
		// 获取照片总数
		$view->photos_count = $common->photosCount();
		// 获取留言总数
		$view->message_count = $common->messageCount();
		// 获取博客文章总数
		$view->article_count = $common->articleCount();
		// 获取博客分类总数
		$view->category_count = $common->categoryCount();
		// 打包数组数据
		$data = ["id"=>$category->cate_id,"name" => $category->cate_name,"desc"=>$category->cate_description,"tags"=>$category->cate_tags];
		// 渲染模板输出
		return $view->fetch('admin/blog/editCategory',$data);
	}
	public function deleteCategory(){
		// 获取post过来的数据
		$data = input('post.');
		// 把json数据转成对象
		$data = json_decode($data['ajaxData']);
		// 获取cate_id
		$cate_id = $data->cate_id;
		// 实例化分类模型
		$category = Category::get($cate_id);
		// 实例化文章模型
		$article = new Article;
		// save方法第二个参数为更新条件，更新删除分类下所有的文章移动到心情随笔下
		$article->save(['cate_id'  => 1],['cate_id' => $cate_id]);
		// 执行删除
		if($category->delete()){
			return json(["message"=>"删除分类成功！","ico" => 1]);
		}
	}
	public function eidtCategoryController(){
		// 获取所有post数据
		$data = input('post.');
		// 查询该id的数据
		$id = $data['id'];
		// 获取id为$id的数据模型
		$category = Category::get($id);	
		// 更新数据模型
		$category->cate_name = $data['category_title'];
		$category->cate_tags = $data['category_tag'];
		$category->cate_description = $data['category_desc'];
		// 修改数据
		if($category->save()){
		// 返回json数据通知
		return json(["message"=>"修改成功！","ico"=>1]);
		}
		return json(["message"=>"你没有修改数据！","ico"=>5]);
	}
	
}

 ?>