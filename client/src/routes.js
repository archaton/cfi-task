import HomeView from "./components/HomeView";
import ResultsView from "./components/ResultsView";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: HomeView,
    },
    {
        path: '/results',
        name: 'Results',
        component: ResultsView,
    }
];

export default routes;
