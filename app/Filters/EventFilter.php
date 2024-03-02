<?php

namespace App\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;

class EventFilter
{
    public $originalEvent;
    public $lazyEvent;
    public $first;
    public $rows;
    public $sortField;
    public $sortOrder;
    public $multiSortMeta;
    public $filters;
    public $pageCount;
    public $page;

    public function __construct($data)
    {
        $this->lazyEvent = isset($data['lazyEvent']) ? (is_string($data['lazyEvent']) ? json_decode($data['lazyEvent'], true) : $data['lazyEvent']) : null;
        $data = $this->lazyEvent;
        $this->originalEvent = isset($data['originalEvent']) ? (is_string($data['originalEvent']) ? json_decode($data['originalEvent'], true) : $data['originalEvent']) : null;
        $this->first = isset($data['first']) ? $data['first'] : null;
        $this->rows = isset($data['rows']) ? $data['rows'] : null;
        $this->sortField = isset($data['sortField']) ? $data['sortField'] : null;
        $this->sortOrder = isset($data['sortOrder']) ? $data['sortOrder'] : null;
        $this->multiSortMeta = isset($data['multiSortMeta']) ? $data['multiSortMeta'] : null;
        $this->filters = isset($data['filters']) ? $data['filters'] : null;
        $this->pageCount = isset($data['pageCount']) ? $data['pageCount'] : null;
        $this->page = isset($data['page']) ? ($data['page'] + 1) : null;
    }

    // Setter and Getter for originalEvent
    public function setOriginalEvent($originalEvent)
    {
        $this->originalEvent = $originalEvent;
    }

    public function getOriginalEvent()
    {
        return $this->originalEvent;
    }

    // Setter and Getter for first
    public function setFirst($first)
    {
        $this->first = $first;
    }

    public function getFirst()
    {
        return $this->first;
    }

    // Setter and Getter for rows
    public function setRows($rows)
    {
        $this->rows = $rows;
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }



    public function appyFilters(&$builder)
    {

        $fillable = $builder->getModel()->getFillable();

        if ($this->filters)
            foreach ($this->filters as $key => $filter) {
                if (in_array($key, $fillable) && $value = $filter['value']) {
                    $matchMode = isset($filter['matchMode']) ? $filter['matchMode'] : null;

                    if ($matchMode) {
                        switch ($matchMode) {
                            case 'contains':
                                $builder = $builder->where($key, 'like', '%' . $value . '%');
                                break;

                            case 'startsWith':
                                $builder = $builder->where($key, 'like', '%' . $value);
                                break;

                            case 'notContains':
                                $builder = $builder->whereNot($key, 'like', '%' . $value . '%');
                                break;

                            case 'endsWith':
                                $builder = $builder->where($key, 'like', $value . '%');
                                break;

                            case 'equals':
                                // $builder = $builder->where($key, 'like', $value . '%');
                                break;

                            case 'notEquals':
                                // $builder = $builder->where($key, 'like', $value . '%');
                                break;

                            default:
                                # code...
                                break;
                        }
                    }
                }
            }
    }

    public function applyFilter(&$builder)
    {

        $models = null;

        $this->appyFilters($builder);


        if ($this->sortField) {
            $sort = $this->sortOrder === -1 ? 'desc' : 'asc';
            $builder = $builder->orderBy($this->sortField, $sort);
        }


        if ($this->page) {

            request()->merge(
                ['page' => $this->page]
            );

            $models = $builder->paginate($this->rows);
        }

        return $models;
    }
}
