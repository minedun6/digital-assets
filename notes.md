##### Using codecourse "Recursive comments" style to build the tree
```php
<?php 
$assets = auth()->user()->assets();

$grouped = $assets->with(['user', 'parent.user'])->get()->groupBy('parent_id');

$root = $grouped->get(null);
return $this->buildTree($root, $grouped);
```

```php
protected function buildTree($root, $groupedChildren) {
    return $root->each(function ($r) use ($groupedChildren) {
        if ($children = $groupedChildren->get($r->id)) {
            $r->children = $children;
            $this->buildTree($r->children, $groupedChildren);
        }
    });
}
```

        return axios.get('/tree', {
            params: {
                id: node.id
            }
        }).then(r => {

            let items = r.data.tree

            items.forEach(setData)

            function setData(item) {
                item.data = item

                if (item.children) {
                    item.children.forEach(setData)
                }
            }

            return items
        })