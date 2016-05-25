class Tag {
    constructor({ slug, data }) {
        if (!slug || !data) {
            throw Error('Tag slug and data cannot be empty');
        }

        this.slug = slug;
        this.data = data;
    }
}

export default Tag;
