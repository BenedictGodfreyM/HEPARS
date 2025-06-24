<?php

namespace App\Repositories;

use App\Models\Recommendation;

class RecommendationRepository
{
    /**
     * Get the total number of recommendations in the database
     * 
     * @return integer
     */
    public function totalRecommendations()
    {
        return Recommendation::count();
    }

    /**
     * Retrieve all recommendations from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allRecommendations($perPage = 10)
    {
        return Recommendation::orderBy("updated_at", "desc")->paginate($perPage);
    }

    /**
     * Retrieve all recommendations from the database (Without Pagination)
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allRecommendationsWithoutPagination()
    {
        return Recommendation::query()->orderBy("updated_at", "desc")->get();
    }

    /**
     * Retrieve all recommendations from a certain user
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function recommendationsFromUser($user_id, $perPage = 10)
    {
        return Recommendation::where('user_id', '=', $user_id)->orderBy("updated_at", "desc")->paginate($perPage);
    }

    /**
     * Retrieve a recommendation by its ID from the database
     * 
     * @param string $id recommendation ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findRecommendation($id)
    {
        return Recommendation::findOrFail($id);
    }

    /**
     * Permanently, delete a recommendation from the database
     * 
     * @param string $id recommendation ID
     * 
     * @return integer Number of records deleted (0 for none)
     */
    public function destroyRecommendation($id)
    {
        $recommendation = Recommendation::findOrFail($id);
        return $recommendation->delete();
    }
}