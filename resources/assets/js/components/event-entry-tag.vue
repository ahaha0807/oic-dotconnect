<template>
    <div>        
        <typeahead placeholder="例:php"
                    key=""
                    async="/api/candidacy_tags?q="
                    template-name="typeahead-github-template"
                    :template="customTemplate"
                    :value.sync="q"
                    :on-hit="tagClick"
                    value-key="name">
        </typeahead>
        <div class="error">{{ error }}</div>
        <div class="event-entry-tag-list">
            <div class="event-entry-tag" v-for="tag in tags">
                <span class="event-entry-tag-item" for="{{tag.name}}" @click="removeTag(tag.name)">
                    {{tag.name}}
                    <i class="fa fa-times" aria-hidden="true"></i>
                </span>
            </div>
        </div>
        <div>
            <input type="hidden" name="tags[]" v-for="tag in tags" :value="tag.name">
        </div>
    </div>
</template>


<script>
    import typeahead from './typeahead.vue'
    import tag from './tag.vue'
    import Vue from 'vue'
    import $ from 'jquery'

    typeahead.ready = function() {};
    typeahead.beforeCompile = function() {
        if (this.templateName && this.templateName !== 'default') {
            Vue.partial(this.templateName, this.template);
        }
    };
    export default {
        components: {
            typeahead: typeahead,
            tag
        },
        props: ['value'],
        data() {
            return {
                customTemplate: '{{item.name}}',
                tags: [],
                q: '',
                error: '',
            }
        },
        created() {
            if (this.value) {
                let tags = this.value.split(',')
                tags = tags.map((name) => {
                    return {
                        name
                    }
                })
                this.$set('tags', tags)
            }
        },
        methods: {
            tagAdd(item) {
                let t;
                if (!this.isAllSpace(item.name)) {
                    if (item.name.length > 1 && item.name.length < 20) {
                        this.error = ''
                        if (this.tags.length > 0) {
                            t = this.tags.find((tag) => {
                                return tag.name === item.name
                            })
                        }
                        if (t === undefined) this.tags.push(item);
                    } else {
                        this.error = '※ 2文字以上19文字以内で入力してください'
                    }
                } else {
                    this.error = '※ 空白以外の文字を入力してください'
                }
            },
            removeTag(name) {
                let result = this.tags.find((tag) => {
                    return tag.name === name
                })
                this.tags.$remove(result)
            },
            tagClick(items) {
                this.tagAdd(items)
                this.$children[0].reset();
            },
            isAllSpace(str) {
                return Array.from(str).every((c) => {
                    return c.charCodeAt() === 32 || c.charCodeAt() === 12288
                })
            }
        },
    }
</script>

<style>
    .event-entry-tag-list {
        height: 35px;
    }
    
    .event-entry-tag {
        display: inline-block;
    }
    
    .event-entry-tag-item {
        margin: 10px 10px 20px 0;
        display: none;
        box-sizing: border-box;
        -webkit-transition: background-color 0.2s linear;
        transition: background-color 0.2s linear;
        position: relative;
        display: inline-block;
        padding: 4px 4px;
        border-radius: 8px;
        background-color: #f6f7f8;
        vertical-align: middle;
        cursor: pointer;
    }
    
    .event-entry-tag-item i {
        margin-left: 5px;
    }
    
    .form-control {
        font-size: 1.2rem;
    }
    
    .dropdown-menu {
        position: absolute;
        display: flex;
        flex-direction: column;
        z-index: 2;
        border: solid 1px lightgray;
        box-shadow: 0px 0px 6px 1px #e6e6e6;
    }
    
    .dropdown-menu li {
        box-sizing: border-box;
        -webkit-transition: background-color 0.2s linear;
        transition: background-color 0.2s linear;
        position: relative;
        display: inline-block;
        padding: 8px;
        vertical-align: middle;
        cursor: pointer;
        box-shadow: 0px 0px 6px 1px #e6e6e6;
    }
    
    .dropdown-menu li:not(.active) {
        background-color: #ffffff;
    }
    
    .dropdown-menu .active {
        background-color: #d3d3d3;
    }
    
    .error {
        font-size: 1.2rem;
        color: red;
    }
</style>