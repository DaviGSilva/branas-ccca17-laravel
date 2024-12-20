<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\ValidateCpfService;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ValidateCpfServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new ValidateCpfService();
    }

    #[DataProvider('validCpfProvider')]
    public function testValidateCpf(string $cpf): void
    {
        $isValid = $this->service->validateCpf($cpf);
        $this->assertTrue($isValid);
    }

    public static function validCpfProvider(): array
    {
        return [
            ['97456321558'],
            ['71428793860'],
            ['87748248800'],
        ];
    }

    #[DataProvider('invalidCpfProvider')]
    public function testInvalidateCpf(string $cpf): void
    {
        $isValid = $this->service->validateCpf($cpf);
        $this->assertFalse($isValid);
    }

    public static function invalidCpfProvider(): array
    {
        return [
            ['123456'],
            [''],
            ['11111111111'],
            ['1234567890987654321'],
        ];
    }
}
