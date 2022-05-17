<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Mockery as m;

class UserTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = new User();
    }

    public function tearDown(): void
    {
        unset($this->user);

        parent::tearDown();
    }

    public function testTable()
    {
        $this->assertEquals('users', $this->user->getTable());
    }

    public function testFillable()
    {
        $fields = [
            'name',
            'email',
            'password',
            'username',
            'avatar',
        ];

        $this->assertEquals($fields, $this->user->getFillable());
    }

    public function testHidden()
    {
        $fields = [
            'password',
            'remember_token',
        ];

        $this->assertEquals($fields, $this->user->getHidden());
    }

    public function testCasts()
    {
        $fields = [
            'email_verified_at' => 'datetime',
            'id' => 'int',
        ];

        $this->assertEquals($fields, $this->user->getCasts());
    }

    public function testStatusAttribute()
    {
        $this->user->setRawAttributes(['status' => User::PENDING]);
        $this->assertEquals(User::PENDING, $this->user->status);

        $this->user->setRawAttributes(['status' => User::ACTIVE]);
        $this->assertEquals(User::ACTIVE, $this->user->status);

        $this->user->setRawAttributes(['status' => User::BANNED]);
        $this->assertEquals(User::BANNED, $this->user->status);

        $this->user->setRawAttributes(['status' => User::INACTIVE]);
        $this->assertEquals(User::INACTIVE, $this->user->status);
    }

    public function testIsActiveFunction()
    {
        $this->assertFalse($this->user->isActive());

        $this->user->setRawAttributes(['status' => User::ACTIVE]);
        $this->assertTrue($this->user->isActive());
    }

    public function testMutators()
    {
        $password = '12345678';

        $this->user->password = $password;

        $this->assertTrue(Hash::check($password, $this->user->password));

        $username = 'Nguyễn Ngọc Công';
        $processedUsername = 'nguyen-ngoc-cong';

        $this->user->username = $username;

        $this->assertEquals($processedUsername, $this->user->username);
    }

    public function testArticlesRelationship()
    {
        $rel = $this->user->articles();

        $this->assertInstanceOf(HasMany::class, $rel);

        $this->assertEquals('author_id', $rel->getForeignKeyName());
        $this->assertEquals('id', $rel->getLocalKeyName());
    }

    public function testGetUnreadNotificationAttribute()
    {
        $this->assertIsNumeric($this->user->unread_notification);
    }
}
