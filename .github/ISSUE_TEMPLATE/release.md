---
name: Release checklist
about: Instructions for packaging a release of utexas-smtp-helper

---

This workflow assumes a "regular release," meaning there are changes already committed to the `develop` branch that are ready to be included in a tagged release.

- [ ] Stage a release branch and pull request using the [Release Stager](https://github.com/utexas-wcms/wcms-devops/actions/workflows/regular-release-stager.yml).
- [ ] Confirm that the staged pull request correctly increments the version number defined in `utexas-smtp-helper.php`
- [ ] Merge the release using [Release Deployer](https://github.com/utexas-wcms/wcms-devops/actions/workflows/regular-release-deployer.yml). This will create a new tag.
- [ ] Confirm that the tag is correctly synced to the public mirror repository at https://github.com/utexas-wp/utexas-smtp-helper/tags . That sync is the responsibility of the `public-github-mirror-sync` GitHub Action in this repository.
- [ ] Download the latest version of the plugin at https://github.com/utexas-wp/utexas-smtp-helper/archive/refs/heads/master.zip . This will download a file named `utexas-smtp-helper-master.zip`
- [ ] Unzip `utexas-smtp-helper-master.zip`, rename the decompressed directory from `utexas-smtp-helper-master` to `utexas-smtp-helper` and compress in zip format so that the resulting file is `utexas-smtp-helper.zip`. **It is important that you do not simply rename the .zip file you downloaded, as this will not change the directory contained in it. We need the directory to be named `utexas-smtp-helper` so that the WordPress UI plugin updater installs the plugin consistently to `wp-content/plugins/utexas-smtp-helper`, rather than `wp-content/plugins/utexas-smtp-helper-master`.**
- [ ] Sign into public GitHub with an account that has administrative access to https://github.com/utexas-wp/utexas-smtp-helper
- [ ] Create a new release pointing to the new tag at https://github.com/utexas-wp/utexas-smtp-helper/releases/new . Use previous releases as the model for the text of the changelog, **adding the `utexas-eid-auth.zip` file as asset where it says "Attach binaries by dropping them here or selecting them."**
- [ ] Clear the nginx cache for the endpoint: `ssh utw10227@panel.utweb.utexas.edu /utweb/common/src/examples/ccache.sh wcms.its.utexas.edu`
- [ ] Confirm that the contents of the latest release asset is available via our download endpoint at https://wcms.its.utexas.edu/download-utexas-smtp-helper.php by unzip the download and confirming that the `utexas-smtp-helper.php` file has the latest version number in its metadata.
