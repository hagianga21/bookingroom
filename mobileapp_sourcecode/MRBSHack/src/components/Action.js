export const FILTER = "FILTER";
export const FETCH = "FETCH";



export function filterRoom(roomStatus)
{
    return { type: FILTER, roomStatus}
}


export function fetchData(dataFromJSON)
{
    return {type: FETCH, dataFromJSON}
}

