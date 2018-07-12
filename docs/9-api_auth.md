##AUTHENTICATE##

http://localhost:8000/public/graphql?query=mutation Authenticate{Authenticate(input: {username:"089654562911",password:"123123123"}) {token,user {id, username, organizations{nama,scopes}}}}


##ADD USER##

http://localhost:8000/public/graphql?query=mutation StoreUser {
  AddUser(username: "0896545629110", password: "newpassword") {
    username, organizations{nama,scopes}
  }
}


##ADD ORG##

http://localhost:8000/public/graphql?query=mutation StoreUser {
  AddOrganization(nama: "AKIRA2") {
    username, organizations{nama,scopes}
  }
}


##REMOVE ORG##

http://localhost:8000/public/graphql?query=mutation StoreUser {
  RemoveOrganization(owner: {username:"089654562911"}, uuid: "6E516C62-25C7-4EB3-9F14-2C1FB5205D1F") {
    username, organizations{nama,scopes,uuid}
  }
}


##ADD SCOPE##

http://localhost:8000/public/graphql?query=mutation StoreUser {
  AddScope(user: {username:"089654562911"}, organization:{uuid:"AF7D149D-F6FF-4DFB-8208-BF06A4F8E3B4"}, scope:"checker") {
    username, organizations{nama,scopes,uuid}
  }
}


##REMOVE SCOPE##

http://localhost:8000/public/graphql?query=mutation StoreUser {RemoveScope(user: {username:"089654562911"}, organization:{uuid:"AF7D149D-F6FF-4DFB-8208-BF06A4F8E3B4"}, scope:"checker") {
    username, organizations{nama,scopes,uuid}
  }
}


##DEACTIVATE##

http://localhost:8000/public/graphql?query=mutation Deactivate {Deactivate(username:"0896545629110") {
    username, organizations{nama,scopes,uuid}
  }
}


##READ USERS##

http://localhost:8000/public/graphql?query=query user{users{username,organizations{nama,scopes}
}}
