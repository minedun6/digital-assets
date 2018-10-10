<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>
                                <i class="far fa-folder"></i>
                                Digital Assets
                            </span>
                            <div class="d-flex">
                                <input type="text" class="form-control form-control-sm mr-3" v-model="query">
                                <div class="dropdown">
                                    <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">

                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">
                                            Open All
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            Collapse All
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            Refresh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- load the tree here -->
                        <liquor-tree
                                ref="tree"
                                :options="fetchExample0"
                                :filter="query"
                        >
                            <div class="tree-scope" slot-scope="{ node }">
                                <template v-if="!node.hasChildren()">
                                    <i :class="node.data.icon"></i>
                                    {{ node.text }}
                                </template>

                                <template v-else>
                                    <i :class="[node.expanded() ? 'far fa-folder-open' : 'far fa-folder']"></i>
                                    {{ node.text }}
                                </template>
                            </div>
                        </liquor-tree>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LiquorTree from 'liquor-tree'

    export default {
        name: 'assets-library',
        data: function () {
            return {
                fetchExample0: {
                    fetchData(node) {
                        // return Promise object
                        return fetch(`/tree?id=${node.id}`).then(r => r.json()).catch(e => console.log(e))
                    }
                },
                query: ''
            }
        },
        components: {
            LiquorTree
        }
    }
</script>

<style>
    .tree-node.matched > .tree-content {
        background: #f7f2e7;
    }
</style>