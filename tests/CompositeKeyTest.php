<?php

namespace Composito\Test;

use Illuminate\Database\QueryException;

class CompositeKeyTest extends TestCase
{
    /**
     * Test getting a model with where clauses.
     * @return void
     */
    public function testGettingAModelWithWhereClauses()
    {
        $foos = Foo::where("primary_one", 1)
            ->where("primary_two", 2)
            ->get();

        $this->assertEquals(1, count($foos));
    }

    /**
     * Test creating a new model.
     * @return void
     */
    public function testCreatingANewModelWithTheSaveMethod()
    {
        $foo = new Foo();
        $foo->primary_one = 10;
        $foo->primary_two = 1;
        $foo->text = "The Text";

        $this->assertTrue($foo->save());
    }

    /**
     * Test creating a new model with the create method.
     * @return void
     */
    public function testCreatingANewModelWithTheCreateMethod()
    {
        $foo = Foo::create([
            "primary_one" => 10,
            "primary_two" => 2,
            "text" => "The Text"
        ]);

        $this->assertEquals($foo->primary_one, 10);
        $this->assertEquals($foo->primary_two, 2);
        $this->assertEquals($foo->text, "The Text");
    }

    /**
     * Test creating a model with existing keys.
     * @return void
     */
    public function testCreatingModelWithExistingKeys()
    {
        $this->expectException(QueryException::class);

        $foo = new Foo();
        $foo->primary_one = 1;
        $foo->primary_two = 2;
        $foo->text = "The Text";
        $foo->save();
    }

    /**
     * Test updating a model with the update() method.
     * @return void
     */
    public function testUpdatingWithTheUpdateMethod()
    {
        $model = Foo::first();

        $model->update([ "text" => "The New Text"]);

        $this->assertEquals($model->text, "The New Text");
    }

    /**
     * Test deleting a model.
     * @return void
     */
    public function testDeletingAModel()
    {
        $foo = Foo::first();
        $foo->delete();

        $deleted = Foo::where("primary_one", $foo->primary_one)
            ->where("primary_two", $foo->primary_two)
            ->first();

        $this->assertNull($deleted);
    }
}