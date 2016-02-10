class StaticController < ApplicationController
  def home
      client = Soundcloud.new(:client_id => ENV["SOUNDCLOUD_CLIENT_ID"])
      @tracks = client.get("/tracks",
                            :limit => 10,
                            :order => "hotness")
  end

  def profile
      user = User.find(session[:user_id])
      token = user.soundcloud_access_token
      client = Soundcloud.new(:access_token => token)
      current_user = client.get("/me")
      @fullname = current_user.full_name
      @username = current_user.username
      @city = current_user.city
      @description = current_user.description
  end

  def likes
      user = User.find(session[:user_id])
      token = user.soundcloud_access_token
      client = Soundcloud.new(:access_token => token)

      current_user = client.get("/me")
      @favorites = client.get("/users/#{current_user.id}/favorites/",
                               :limit => 21)
  end

  def playlists
      user = User.find(session[:user_id])
      token = user.soundcloud_access_token
      client = Soundcloud.new(:access_token => token)

      current_user = client.get("/me")
      @playlists = client.get("/users/#{current_user.id}/playlists/")
  end

  def update
      user = User.find(session[:user_id])
      token = user.soundcloud_access_token
      client = Soundcloud.new(:access_token => token)
      current_user = client.get("/me")
      @fullname = current_user.full_name
      @city = current_user.city
      @description = current_user.description
  end

  def update_user
      user = User.find(session[:user_id])
      token = user.soundcloud_access_token
      client = Soundcloud.new(:access_token => token)
      client.put("/me",
                  :user => {
                    :full_name => params["fullname"],
                    :city => params["city"],
                    :description => params["description"]
                  })

      redirect_to profile_path
  end
end
