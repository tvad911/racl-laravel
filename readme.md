<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Đây là một project được xây dựng để phân quyền user trong laravel. 
Phân quyền chia thành: Permission, Role, Group, User. Theo RACL, là cái khó nhất trong phân quyền, theo như lý thuyết hay suy nghĩ thì thư viện mình đang xài có điểm hơi khác. 

## Các thư viện được sử dụng trong project:

- [Laravel Repository](https://github.com/andersao/l5-repository).
Thư viện này hỗ trợ các bạn tạo các module nhanh chóng, nhưng mình cảm nhận là quá phức tạp, 
phân chia code ra rất nhiều, thực sự thì làm cho tốn rất nhiều sức. Về lý thuyết có thể giúp giảm thiểu quá trình sau này bảo trì code.

Hiện mình đã viết tạo các module sử dụng thư viện này ok, nhưng vẫn còn một vài lỗi về việc search, uupdate multi, các bạn có thể dành thời gian sửa lại, viết thêm filter multi cho nó.

- [RACL] (https://github.com/signes-pl/laravel-acl)
Thư viện này, mình tìm thấy năm 2015, thấy thích muốn viết nhưng chỉ viết vào năm 2016, nhưng cả mấy tháng mới xem một lần. Giờ thì mình không còn đụng vào nữa, thực tế đôi khi không cần điều gì phức tạp.
Sang tới 2017 mình mới xem lại và viết tới phần tạo giao diện, thêm các Permission, Role, Group rồi tiến hành áp vào Policy để test và thấy hoạt động.
Vậy phần việc còn lại của các bạn là: kiểm tra xem có lỗi gì, áp dụng phần permission sau khi trả về, kết hợp với policy và midleware + authen trong request để check phân quyền tới từng dòng code hay modulle.
Về phần policy xem tại: # https://laravel.com/docs/5.5/authorization

Một số lưu ý nhỏ: Nếu dùng, trong controller: 
$this->authorize('index', $group);

Thì trong Policy: 

class GroupPolicy
{
    use HandlesAuthorization;
    protected $resource = 'admin.group';

    /**
     * Determine whether the user can view the group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function index(User $user, Group $group)
    {
        $resource = $this->resource. '|index';
        if(\Acl::isAllow($resource, $user))
        {
            return true;
        }
    }
}

Bạn phải map các method trong Policy và method trong Controller:
/**
 * Get the map of resource methods to ability names.
 *
 * @return array
 */
protected function resourceAbilityMap()
{
	return [
		'index' => 'index',
		'create' => 'create',
		'store' => 'store',
		'show' => 'show',
		'edit' => 'edit',
		'update' => 'update',
		'destroy' => 'destroy',
		'delete' => 'delete'
	];
}

Thì nó mới biết đâu là action cần kiểm tra.

## Liên hệ:
Skype: tvad911
Facebook: anhduongphuong

## Lời ngỏ
Mình chưa có cái project nào gọi là làm cho khách hàng thực tế cả, nhưng đây là cái mình đã viết, có thể không đúng chuẩn.
Thiếu việc test hay các phần khác, nhưng hi vọng, nếu ai đó xem và thích project này,
Có thể biến nó thành một base cms hoặc ứng dụng viết lại một cms trên vuejs2 chẳng hạn, để chia sẻ với mọi người.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
