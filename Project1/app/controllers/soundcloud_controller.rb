class SoundcloudController < ApplicationController
  def connect
    client = Soundcloud.new(:client_id => ENV['SOUNDCLOUD_CLIENT_ID'],
                            :client_secret => ENV['SOUNDCLOUD_CLIENT_SECRET'],
                            :redirect_uri => 'http://localhost:3000/soundcloud/oauth-callback',
                            :response_type => 'code')

    redirect_to client.authorize_url(:grant_type => 'authorization_code',
                                     :scope => 'non-expiring',
                                     :display => 'popup')
  end

  def connected
    client = Soundcloud.new(:client_id => ENV['SOUNDCLOUD_CLIENT_ID'],
                            :client_secret => ENV['SOUNDCLOUD_CLIENT_SECRET'],
                            :redirect_uri => 'http://localhost:3000/soundcloud/oauth-callback')

    access_token = client.exchange_token(:code => params[:code])
    client = Soundcloud.new(:access_token => access_token['access_token'])

    soundcloud_user = client.get('/me')
    unless User.where(:soundcloud_user_id => soundcloud_user['id']).present?
      User.create_from_soundcloud(soundcloud_user, access_token)
    end
    sign_in_user = User.where(:soundcloud_user_id => soundcloud_user['id'])

    session[:user_id] = sign_in_user.first.id

    redirect_to root_url, notice: 'Signed in!'
  end

  def destroy
    session[:user_id] = nil
    redirect_to root_url, notice: 'Logged out!'
  end
end
