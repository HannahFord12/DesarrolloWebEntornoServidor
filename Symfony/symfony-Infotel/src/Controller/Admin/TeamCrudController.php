<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class TeamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('name'),
            Field::new('brand'),
            Field::new('processor'),
            IntegerField::new('ram'),
            IntegerField::new('storage'),
            NumberField::new('price'),
            ImageField::new('photo')->setUploadDir('/public/img')->setBasePath('/img/')
            
        ];
    }
}
