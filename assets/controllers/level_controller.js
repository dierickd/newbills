import {Controller} from '@hotwired/stimulus';
import axios from "axios";

export default class extends Controller {
    static values = {
        infoUrl: String
    }

    selected(event) {
        axios.get(this.infoUrlValue).then(() => window.location.reload());
    }
}
