import Tag from './Tag';
import slug from 'slug';

const TagManager = {
    _tags: [],

    init(...tags) {
        this._tags = [];

        if (tags.length > 0) {
            this.addTags(tags);
        }
    },

    getTags() {
        return this._tags;
    },

    getTag(idx) {
        return this._tags[idx];
    },

    get total() {
        return this._tags.length;
    },

    addTags(...tags) {
        if (!tags.length) {
            throw Error('Expected at least one tag to insert [addTag]');
        }

        tags.forEach(tag => {
            let newTag = tag;

            if (!tag instanceof Tag && (typeof tag !== 'string')) {
                throw Error(
                    'Expected an instance of Tag or an object with format ' +
                    '{slug: String, data: String} [addTag]'
                );
            }

            if (!(tag instanceof Tag)) {
                newTag = new Tag({ slug: slug(tag), data: tag });
            }

            this._tags.push(newTag);
        });

        return;
    },

    removeTag(tag) {
        const idx = this._tags.indexOf(tag);

        this._tags.splice(idx, 1);
        return;
    }

};

export default TagManager;
