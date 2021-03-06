<?php
namespace Codemonkey1988\ResponsiveImages\Tests\Unit\Resource\Service;

/*
 * This file is part of the TYPO3 responsive images project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read
 * LICENSE file that was distributed with this source code.
 *
 */

use Codemonkey1988\ResponsiveImages\Resource\Service\PictureImageVariant;
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Test class for \Codemonkey1988\ResponsiveImages\Resource\Service\PictureImageVariant
 */
class PictureImageVariantTest extends UnitTestCase
{
    /**
     * Test if the default width can be set.
     *
     * @test
     */
    public function settingDefaultWidthWillWork()
    {
        /** @var PictureImageVariant|\PHPUnit_Framework_MockObject_MockObject $pictureImageVariant */
        $pictureImageVariant = $this->getAccessibleMock(PictureImageVariant::class, ['__construct'], ['test']);
        $pictureImageVariant->setDefaultWidth('2000');

        $this->assertEquals('2000', $pictureImageVariant->getDefaultWidth());
    }

    /**
     * Test if the default height can be set.
     *
     * @test
     */
    public function settingDefaultHeightWillWork()
    {
        /** @var PictureImageVariant|\PHPUnit_Framework_MockObject_MockObject $pictureImageVariant */
        $pictureImageVariant = $this->getAccessibleMock(PictureImageVariant::class, ['__construct'], ['test']);
        $pictureImageVariant->setDefaultHeight('700');

        $this->assertEquals('700', $pictureImageVariant->getDefaultHeight());
    }

    /**
     * Tests if a source configuration can be added.
     *
     * @test
     */
    public function addSingleSourceConfig()
    {
        $media = '(max-width: 64em)';
        $srcsets = [
            '1x' => ['width' => '1280c', 'height' => '600c', 'quality' => '80'],
            '2x' => ['width' => '2560c', 'height' => '1200c', 'quality' => '50'],
        ];
        $expected = [
            0 => [
                'media' => $media,
                'srcset' => $srcsets,
                'croppingVariantKey' => 'default',
            ],
        ];

        /** @var PictureImageVariant|\PHPUnit_Framework_MockObject_MockObject $pictureImageVariant */
        $pictureImageVariant = $this->getAccessibleMock(PictureImageVariant::class, ['__construct'], ['test']);
        $pictureImageVariant->addSourceConfig($media, $srcsets);

        $this->assertTrue(is_array($pictureImageVariant->getAllSourceConfig()));
        $this->assertEquals($expected, $pictureImageVariant->getAllSourceConfig());
    }

    /**
     * Tests if a multiple source configurations can be added.
     *
     * @test
     */
    public function addMultipleSourceConfig()
    {
        $media1 = '(max-width: 64em)';
        $media2 = '(max-width: 40em)';
        $srcset1 = [
            '1x' => ['width' => '1280c', 'height' => '600c', 'quality' => '80'],
            '2x' => ['width' => '2560c', 'height' => '1200c', 'quality' => '50'],
        ];
        $srcset2 = [
            '1x' => ['width' => '360c', 'height' => '200c', 'quality' => '50'],
            '2x' => ['width' => '7200c', 'height' => '400c', 'quality' => '60'],
        ];
        $expected = [
            0 => [
                'media' => $media1,
                'srcset' => $srcset1,
                'croppingVariantKey' => 'default',
            ],
            1 => [
                'media' => $media2,
                'srcset' => $srcset2,
                'croppingVariantKey' => 'default',
            ],
        ];

        /** @var PictureImageVariant|\PHPUnit_Framework_MockObject_MockObject $pictureImageVariant */
        $pictureImageVariant = $this->getAccessibleMock(PictureImageVariant::class, ['__construct'], ['test']);
        $pictureImageVariant->addSourceConfig($media1, $srcset1);
        $pictureImageVariant->addSourceConfig($media2, $srcset2);

        $this->assertTrue(is_array($pictureImageVariant->getAllSourceConfig()));
        $this->assertEquals($expected, $pictureImageVariant->getAllSourceConfig());
    }

    /**
     * Tests if a source configuration can be added with a custo mcropping variant key
     *
     * @test
     */
    public function addSingleSourceConfigWithCroppingVariantKey()
    {
        $croppingVariantKey = 'mobile';
        $media = '(max-width: 64em)';
        $srcsets = [
            '1x' => ['width' => '1280c', 'height' => '600c', 'quality' => '80'],
            '2x' => ['width' => '2560c', 'height' => '1200c', 'quality' => '50'],
        ];
        $expected = [
            0 => [
                'media' => $media,
                'srcset' => $srcsets,
                'croppingVariantKey' => $croppingVariantKey,
            ],
        ];

        /** @var PictureImageVariant|\PHPUnit_Framework_MockObject_MockObject $pictureImageVariant */
        $pictureImageVariant = $this->getAccessibleMock(PictureImageVariant::class, ['__construct'], ['test']);
        $pictureImageVariant->addSourceConfig($media, $srcsets, $croppingVariantKey);

        $this->assertTrue(is_array($pictureImageVariant->getAllSourceConfig()));
        $this->assertEquals($expected, $pictureImageVariant->getAllSourceConfig());
    }

    /**
     * Tests if a multiple source configurations can be added.
     *
     * @test
     */
    public function addMultipleSourceConfigWithCroppingVariantKey()
    {
        $croppingVariantKey1 = 'mobile';
        $croppingVariantKey2 = 'desktop';
        $media1 = '(max-width: 64em)';
        $media2 = '(max-width: 40em)';
        $srcset1 = [
            '1x' => ['width' => '1280c', 'height' => '600c', 'quality' => '80'],
            '2x' => ['width' => '2560c', 'height' => '1200c', 'quality' => '50'],
        ];
        $srcset2 = [
            '1x' => ['width' => '360c', 'height' => '200c', 'quality' => '50'],
            '2x' => ['width' => '7200c', 'height' => '400c', 'quality' => '60'],
        ];
        $expected = [
            0 => [
                'media' => $media1,
                'srcset' => $srcset1,
                'croppingVariantKey' => $croppingVariantKey1,
            ],
            1 => [
                'media' => $media2,
                'srcset' => $srcset2,
                'croppingVariantKey' => $croppingVariantKey2,
            ],
        ];

        /** @var PictureImageVariant|\PHPUnit_Framework_MockObject_MockObject $pictureImageVariant */
        $pictureImageVariant = $this->getAccessibleMock(PictureImageVariant::class, ['__construct'], ['test']);
        $pictureImageVariant->addSourceConfig($media1, $srcset1, $croppingVariantKey1);
        $pictureImageVariant->addSourceConfig($media2, $srcset2, $croppingVariantKey2);

        $this->assertTrue(is_array($pictureImageVariant->getAllSourceConfig()));
        $this->assertEquals($expected, $pictureImageVariant->getAllSourceConfig());
    }
}
