<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{

    #region Private Functions

    /**
     * Verify if the given id is an integer
     * @param $id
     * @throws Exception
     */
    private function checkInteger($id): void
    {
        if (!is_numeric($id)) {
            throw new Exception("The given ID is not an integer.", 400);
        }
    }

    /**
     * Check if Item exists
     * If NOT throw an Exception
     * Else return Item
     * @param $id
     * @return Item
     * @throws Exception
     */
    private function checkIfItemExist($id): Item
    {
        // Get Item
        $item = Item::find($id);
        // Check if Item exist
        if (!$item) {
            throw new Exception("No item found with the following ID : " . $id . ".", 404);
        }
        return $item;
    }

    #endregion

    #region Public Functions

    /**
     * Get all items
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            // Get all items
            $items = Item::all();

            // Return response
            return response()->json($items);

        } catch (Exception $exception) {
            // If Exception return error
            return response()->json([
                "message" => "Error when getting items.",
                "details" => $exception->getMessage()
            ], $exception->getCode() != null && $exception->getCode() != 0 ? $exception->getCode() : 500);
        }
    }

    /**
     * Get one item
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            // Check ID value
            $this->checkInteger($id);

            // Check if Item exists and get Item
            $item = $this->checkIfItemExist($id);

            // Return response
            return response()->json($item);

        } catch (Exception $exception) {
            // If Exception return error
            return response()->json([
                "message" => "Error when getting item.",
                "details" => $exception->getMessage()
            ], $exception->getCode() != null && $exception->getCode() != 0 ? $exception->getCode() : 500);
        }
    }

    /**
     * Create an item
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate the data
            $data = $this->validate($request, [
                "name" => "required|max:255",
                "vegetarian" => "boolean",
                "vegan" => "boolean",
                "glutenfree" => "boolean",
                "sweet" => "boolean",
                "salty" => "boolean",
                "spicy_level" => "in:0,1,2,3",
            ]);

            // Create an item
            $item = Item::create($data);

            // Save Item
            if (!$item->save()) {
                throw new Exception("Could not save item.", 500);
            }

            // Return response
            return response()->json($item);

        } catch (ValidationException $validationException) {
            // If ValidationException return error
            return response()->json([
                "message" => "Error when validating the data.",
                "details" => $validationException->getMessage()
            ], 400);
        } catch (Exception $exception) {
            // If Exception return error
            return response()->json([
                "message" => "Error when creating item.",
                "details" => $exception->getMessage()
            ], $exception->getCode() != null && $exception->getCode() != 0 ? $exception->getCode() : 500);
        }
    }

    /**
     * Update an item
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        try {
            // Validate the data
            $data = $this->validate($request, [
                "name" => "max:255",
                "vegetarian" => "boolean",
                "vegan" => "boolean",
                "glutenfree" => "boolean",
                "sweet" => "boolean",
                "salty" => "boolean",
                "spicy_level" => "in:0,1,2,3",
            ]);
            // Check ID value
            $this->checkInteger($id);

            // Check if Item exists and get Item
            $item = $this->checkIfItemExist($id);

            // Update item
            $item->update($data);

            // Save Item
            if (!$item->save()) {
                throw new Exception("Could not save item.", 500);
            }

            // Return response
            return response()->json($item);

        } catch (ValidationException $validationException) {
            // If ValidationException return error
            return response()->json([
                "message" => "Error when validating the data.",
                "details" => $validationException->getMessage()
            ], 400);
        } catch (Exception $exception) {
            // If Exception return error
            return response()->json([
                "message" => "Error when updating item.",
                "details" => $exception->getMessage()
            ], $exception->getCode() != null && $exception->getCode() != 0 ? $exception->getCode() : 500);
        }
    }

    /**
     * Delete an item
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            // Check ID value
            $this->checkInteger($id);

            // Check if Item exists and get Item
            $item = $this->checkIfItemExist($id);

            // Delete Item
            $item->delete();

            // Return response
            return response()->json([
                "message" => "Item deleted."
            ]);

        } catch (Exception $exception) {
            // If Exception return error
            return response()->json([
                "message" => "Error when deleting item.",
                "details" => $exception->getMessage()
            ], $exception->getCode() != null && $exception->getCode() != 0 ? $exception->getCode() : 500);
        }
    }

    #endregion
}
