export default class jsonResponses {
    flattenErrors(errorProp) {
        const errors = []
        for (const [key, val] of Object.entries(errorProp)) {
            for (const err of val) {
                errors.push(err)
            }
        }
        return errors;
    }
}